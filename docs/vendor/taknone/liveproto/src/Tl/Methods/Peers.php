<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Methods;

use Tak\Liveproto\Enums\PeerType;

trait Peers {
	private const MIN_CHAT_ID = -999999999999;
	private const MIN_CHANNEL_ID = (1 << 31) - 2000000000000;
	private const MIN_SECRET_CHAT_ID = - (1 << 31) - 2000000000000;

	public function get_input_peer(string | int | null | object $peer,int $hash = 0) : mixed {
		if(is_null($peer)):
			return $this->inputPeerEmpty();
		elseif(is_object($peer)):
			if(isset($peer->user_id) and is_int($peer->user_id)):
				return $this->get_input_peer($peer->user_id,$hash);
			elseif(isset($peer->chat_id) and is_int($peer->chat_id)):
				return $this->get_input_peer($peer->chat_id,$hash);
			elseif(isset($peer->channel_id) and is_int($peer->channel_id)):
				return $this->get_input_peer($peer->channel_id,$hash);
			else:
				# return $peer;
				throw new \Exception('A valid peer id was not found in your object');
			endif;
		elseif(is_string($peer)):
			if(in_array($peer,array('me','bot'))):
				return $this->inputPeerSelf();
			elseif(filter_var($peer,FILTER_VALIDATE_URL)):
				$path = parse_url($peer,PHP_URL_PATH);
				if(is_null($path) === false):
					$hash = trim(basename($path),chr(43));
					$checked = $this->messages->checkChatInvite($hash);
					if($checked instanceof \Tak\Liveproto\Tl\Types\Other\ChatInvite):
						throw new \BadMethodCallException('You must first use the `importChatInvite` method to join the chat');
					else:
						return $this->get_input_peer($checked->chat->id,isset($checked->chat->access_hash) ? $checked->chat->access_hash : 0);
					endif;
				else:
					throw new \InvalidArgumentException('This method only accepts private links for chats as https://t.me/+abcd...');
				endif;
			elseif(str_starts_with($peer,'+')):
				$phone = preg_replace('/[^0-9]/i',(string) null,$peer);
				$resolve = $this->contacts->resolvePhone($phone);
			else:
				$username = preg_replace('/[^a-z_0-9]/i',(string) null,$peer);
				$resolve = $this->contacts->resolveUsername($username);
			endif;
			return $this->get_input_peer($resolve->peer);
		elseif(is_int($peer)):
			if($peer < 0):
				if(self::MIN_CHAT_ID <= $peer):
					$peer = - $peer;
				elseif(self::MIN_CHANNEL_ID <= $peer):
					$peer = - $peer - 1000000000000;
				elseif(self::MIN_SECRET_CHAT_ID <= $peer):
					$peer = $peer - 2000000000000;
				endif;
			endif;
			if($chat = $this->load->peers->getPeer(type : 'chats',by : 'id',what : $peer)):
				return $this->inputPeerChannel(channel_id : $peer,access_hash : $chat['access_hash']);
			elseif($user = $this->load->peers->getPeer(type : 'users',by : 'id',what : $peer)):
				return $this->inputPeerUser(user_id : $peer,access_hash : $user['access_hash']);
			elseif($secret = $this->load->peers->getPeer(type : 'secrets',by : 'id',what : $peer)):
				return $this->inputEncryptedChat(chat_id : $peer,access_hash : $secret['access_hash']);
			else:
				try {
					$entity = $this->inputPeerUser(user_id : $peer,access_hash : $hash);
					$user = $this->users->getFullUser($entity)->users[false];
					$this->load->peers->setPeers(type : 'users',peers : [array('id'=>$user->id,'access_hash'=>$user->access_hash)]);
					return $entity;
				} catch(\Throwable){
					try {
						$entity = $this->inputPeerChannel(channel_id : $peer,access_hash : $hash);
						$channel = $this->channels->getFullChannel($entity)->chats[false];
						$this->load->peers->setPeers(type : 'chats',peers : [array('id'=>$channel->id,'access_hash'=>$channel->access_hash)]);
						return $entity;
					} catch(\Throwable){
						return $this->inputPeerChat(chat_id : $peer);
					}
				}
			endif;
		endif;
	}
	public function get_peer(string | int | object $peer) : object {
		$peer = $this->get_input_peer($peer);
		if(isset($peer->channel_id)):
			return $this->channels->getFullChannel($peer)->chats[false];
		elseif(isset($peer->chat_id)):
			return $this->messages->getFullChat($peer->chat_id)->chats[false];
		else:
			return $this->users->getFullUser($peer)->users[false];
		endif;
	}
	public function get_full_peer(string | int | object $peer) : object {
		$peer = $this->get_input_peer($peer);
		if(isset($peer->channel_id)):
			return $this->channels->getFullChannel($peer)->full_chat;
		elseif(isset($peer->chat_id)):
			return $this->messages->getFullChat($peer->chat_id)->full_chat;
		else:
			return $this->users->getFullUser($peer)->full_user;
		endif;
	}
	public function get_peer_id(string | int | object $peer) : int {
		static $cache = array();
		$hash = md5(serialize($peer));
		if(key_exists($hash,$cache) === false):
			$id = match(true){
				isset($peer->user_id) and is_int($peer->user_id) => $peer->user_id,
				isset($peer->chat_id) and is_int($peer->chat_id) => $peer->chat_id,
				isset($peer->channel_id) and is_int($peer->channel_id) => $peer->channel_id,
				default => $this->get_full_peer($peer)->id
			};
			$cache[$hash] = $id;
		endif;
		return $cache[$hash];
	}
	public function get_peer_type(string | int | object $peer) : object {
		static $cache = array();
		$hash = md5(serialize($peer));
		if(key_exists($hash,$cache) === false):
			$info = $this->get_peer($peer);
			if(str_contains(get_class($info),'User')):
				$cache[$hash] = match(true){
					$info->self => PeerType::SELF,
					$info->bot => PeerType::BOT,
					default => PeerType::USER
				};
			elseif(str_contains(get_class($info),'Chat')):
				$cache[$hash] = PeerType::CHAT;
			elseif(str_contains(get_class($info),'Channel')):
				$cache[$hash] = match(true){
					$info->broadcast => PeerType::CHANNEL,
					$info->megagroup => PeerType::MEGAGROUP,
					$info->gigagroup => PeerType::GIGAGROUP
				};
			endif;
		endif;
		return $cache[$hash];
	}
}

?>