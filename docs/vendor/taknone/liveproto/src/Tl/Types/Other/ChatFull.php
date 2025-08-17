<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id string about chatparticipants participants peernotifysettings notify_settings true can_set_username true has_scheduled true translations_disabled photo chat_photo exportedchatinvite exported_invite Vector<BotInfo> bot_info int pinned_msg_id int folder_id inputgroupcall call int ttl_period peer groupcall_default_join_as string theme_emoticon int requests_pending Vector<long> recent_requesters chatreactions available_reactions int reactions_limit
 * @return ChatFull
 */

final class ChatFull extends Instance {
	public function request(int $id,string $about,object $participants,object $notify_settings,? true $can_set_username = null,? true $has_scheduled = null,? true $translations_disabled = null,? object $chat_photo = null,? object $exported_invite = null,? array $bot_info = null,? int $pinned_msg_id = null,? int $folder_id = null,? object $call = null,? int $ttl_period = null,? object $groupcall_default_join_as = null,? string $theme_emoticon = null,? int $requests_pending = null,? array $recent_requesters = null,? object $available_reactions = null,? int $reactions_limit = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2633421b);
		$flags = 0;
		$flags |= is_null($can_set_username) ? 0 : (1 << 7);
		$flags |= is_null($has_scheduled) ? 0 : (1 << 8);
		$flags |= is_null($translations_disabled) ? 0 : (1 << 19);
		$flags |= is_null($chat_photo) ? 0 : (1 << 2);
		$flags |= is_null($exported_invite) ? 0 : (1 << 13);
		$flags |= is_null($bot_info) ? 0 : (1 << 3);
		$flags |= is_null($pinned_msg_id) ? 0 : (1 << 6);
		$flags |= is_null($folder_id) ? 0 : (1 << 11);
		$flags |= is_null($call) ? 0 : (1 << 12);
		$flags |= is_null($ttl_period) ? 0 : (1 << 14);
		$flags |= is_null($groupcall_default_join_as) ? 0 : (1 << 15);
		$flags |= is_null($theme_emoticon) ? 0 : (1 << 16);
		$flags |= is_null($requests_pending) ? 0 : (1 << 17);
		$flags |= is_null($recent_requesters) ? 0 : (1 << 17);
		$flags |= is_null($available_reactions) ? 0 : (1 << 18);
		$flags |= is_null($reactions_limit) ? 0 : (1 << 20);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->tgwriteBytes($about);
		$writer->write($participants->read());
		if(is_null($chat_photo) === false):
			$writer->write($chat_photo->read());
		endif;
		$writer->write($notify_settings->read());
		if(is_null($exported_invite) === false):
			$writer->write($exported_invite->read());
		endif;
		if(is_null($bot_info) === false):
			$writer->tgwriteVector($bot_info,'BotInfo');
		endif;
		if(is_null($pinned_msg_id) === false):
			$writer->writeInt($pinned_msg_id);
		endif;
		if(is_null($folder_id) === false):
			$writer->writeInt($folder_id);
		endif;
		if(is_null($call) === false):
			$writer->write($call->read());
		endif;
		if(is_null($ttl_period) === false):
			$writer->writeInt($ttl_period);
		endif;
		if(is_null($groupcall_default_join_as) === false):
			$writer->write($groupcall_default_join_as->read());
		endif;
		if(is_null($theme_emoticon) === false):
			$writer->tgwriteBytes($theme_emoticon);
		endif;
		if(is_null($requests_pending) === false):
			$writer->writeInt($requests_pending);
		endif;
		if(is_null($recent_requesters) === false):
			$writer->tgwriteVector($recent_requesters,'long');
		endif;
		if(is_null($available_reactions) === false):
			$writer->write($available_reactions->read());
		endif;
		if(is_null($reactions_limit) === false):
			$writer->writeInt($reactions_limit);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 7)):
			$result['can_set_username'] = true;
		else:
			$result['can_set_username'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['has_scheduled'] = true;
		else:
			$result['has_scheduled'] = false;
		endif;
		if($flags & (1 << 19)):
			$result['translations_disabled'] = true;
		else:
			$result['translations_disabled'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['about'] = $reader->tgreadBytes();
		$result['participants'] = $reader->tgreadObject();
		if($flags & (1 << 2)):
			$result['chat_photo'] = $reader->tgreadObject();
		else:
			$result['chat_photo'] = null;
		endif;
		$result['notify_settings'] = $reader->tgreadObject();
		if($flags & (1 << 13)):
			$result['exported_invite'] = $reader->tgreadObject();
		else:
			$result['exported_invite'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['bot_info'] = $reader->tgreadVector('BotInfo');
		else:
			$result['bot_info'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['pinned_msg_id'] = $reader->readInt();
		else:
			$result['pinned_msg_id'] = null;
		endif;
		if($flags & (1 << 11)):
			$result['folder_id'] = $reader->readInt();
		else:
			$result['folder_id'] = null;
		endif;
		if($flags & (1 << 12)):
			$result['call'] = $reader->tgreadObject();
		else:
			$result['call'] = null;
		endif;
		if($flags & (1 << 14)):
			$result['ttl_period'] = $reader->readInt();
		else:
			$result['ttl_period'] = null;
		endif;
		if($flags & (1 << 15)):
			$result['groupcall_default_join_as'] = $reader->tgreadObject();
		else:
			$result['groupcall_default_join_as'] = null;
		endif;
		if($flags & (1 << 16)):
			$result['theme_emoticon'] = $reader->tgreadBytes();
		else:
			$result['theme_emoticon'] = null;
		endif;
		if($flags & (1 << 17)):
			$result['requests_pending'] = $reader->readInt();
		else:
			$result['requests_pending'] = null;
		endif;
		if($flags & (1 << 17)):
			$result['recent_requesters'] = $reader->tgreadVector('long');
		else:
			$result['recent_requesters'] = null;
		endif;
		if($flags & (1 << 18)):
			$result['available_reactions'] = $reader->tgreadObject();
		else:
			$result['available_reactions'] = null;
		endif;
		if($flags & (1 << 20)):
			$result['reactions_limit'] = $reader->readInt();
		else:
			$result['reactions_limit'] = null;
		endif;
		return new self($result);
	}
}

?>