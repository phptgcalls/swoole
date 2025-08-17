<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id string title chatphoto photo int date true creator true left true broadcast true verified true megagroup true restricted true signatures true min true scam true has_link true has_geo true slowmode_enabled true call_active true call_not_empty true fake true gigagroup true noforwards true join_to_send true join_request true forum true stories_hidden true stories_hidden_min true stories_unavailable true signature_profiles true autotranslation true broadcast_messages_allowed true monoforum true forum_tabs long access_hash string username Vector<RestrictionReason> restriction_reason chatadminrights admin_rights chatbannedrights banned_rights chatbannedrights default_banned_rights int participants_count Vector<Username> usernames int stories_max_id peercolor color peercolor profile_color emojistatus emoji_status int level int subscription_until_date long bot_verification_icon long send_paid_messages_stars long linked_monoforum_id
 * @return Chat
 */

final class Channel extends Instance {
	public function request(int $id,string $title,object $photo,int $date,? true $creator = null,? true $left = null,? true $broadcast = null,? true $verified = null,? true $megagroup = null,? true $restricted = null,? true $signatures = null,? true $min = null,? true $scam = null,? true $has_link = null,? true $has_geo = null,? true $slowmode_enabled = null,? true $call_active = null,? true $call_not_empty = null,? true $fake = null,? true $gigagroup = null,? true $noforwards = null,? true $join_to_send = null,? true $join_request = null,? true $forum = null,? true $stories_hidden = null,? true $stories_hidden_min = null,? true $stories_unavailable = null,? true $signature_profiles = null,? true $autotranslation = null,? true $broadcast_messages_allowed = null,? true $monoforum = null,? true $forum_tabs = null,? int $access_hash = null,? string $username = null,? array $restriction_reason = null,? object $admin_rights = null,? object $banned_rights = null,? object $default_banned_rights = null,? int $participants_count = null,? array $usernames = null,? int $stories_max_id = null,? object $color = null,? object $profile_color = null,? object $emoji_status = null,? int $level = null,? int $subscription_until_date = null,? int $bot_verification_icon = null,? int $send_paid_messages_stars = null,? int $linked_monoforum_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfe685355);
		$flags = 0;
		$flags |= is_null($creator) ? 0 : (1 << 0);
		$flags |= is_null($left) ? 0 : (1 << 2);
		$flags |= is_null($broadcast) ? 0 : (1 << 5);
		$flags |= is_null($verified) ? 0 : (1 << 7);
		$flags |= is_null($megagroup) ? 0 : (1 << 8);
		$flags |= is_null($restricted) ? 0 : (1 << 9);
		$flags |= is_null($signatures) ? 0 : (1 << 11);
		$flags |= is_null($min) ? 0 : (1 << 12);
		$flags |= is_null($scam) ? 0 : (1 << 19);
		$flags |= is_null($has_link) ? 0 : (1 << 20);
		$flags |= is_null($has_geo) ? 0 : (1 << 21);
		$flags |= is_null($slowmode_enabled) ? 0 : (1 << 22);
		$flags |= is_null($call_active) ? 0 : (1 << 23);
		$flags |= is_null($call_not_empty) ? 0 : (1 << 24);
		$flags |= is_null($fake) ? 0 : (1 << 25);
		$flags |= is_null($gigagroup) ? 0 : (1 << 26);
		$flags |= is_null($noforwards) ? 0 : (1 << 27);
		$flags |= is_null($join_to_send) ? 0 : (1 << 28);
		$flags |= is_null($join_request) ? 0 : (1 << 29);
		$flags |= is_null($forum) ? 0 : (1 << 30);
		$flags |= is_null($access_hash) ? 0 : (1 << 13);
		$flags |= is_null($username) ? 0 : (1 << 6);
		$flags |= is_null($restriction_reason) ? 0 : (1 << 9);
		$flags |= is_null($admin_rights) ? 0 : (1 << 14);
		$flags |= is_null($banned_rights) ? 0 : (1 << 15);
		$flags |= is_null($default_banned_rights) ? 0 : (1 << 18);
		$flags |= is_null($participants_count) ? 0 : (1 << 17);
		$writer->writeInt($flags);
		$flags2 = 0;
		$flags2 |= is_null($stories_hidden) ? 0 : (1 << 1);
		$flags2 |= is_null($stories_hidden_min) ? 0 : (1 << 2);
		$flags2 |= is_null($stories_unavailable) ? 0 : (1 << 3);
		$flags2 |= is_null($signature_profiles) ? 0 : (1 << 12);
		$flags2 |= is_null($autotranslation) ? 0 : (1 << 15);
		$flags2 |= is_null($broadcast_messages_allowed) ? 0 : (1 << 16);
		$flags2 |= is_null($monoforum) ? 0 : (1 << 17);
		$flags2 |= is_null($forum_tabs) ? 0 : (1 << 19);
		$flags2 |= is_null($usernames) ? 0 : (1 << 0);
		$flags2 |= is_null($stories_max_id) ? 0 : (1 << 4);
		$flags2 |= is_null($color) ? 0 : (1 << 7);
		$flags2 |= is_null($profile_color) ? 0 : (1 << 8);
		$flags2 |= is_null($emoji_status) ? 0 : (1 << 9);
		$flags2 |= is_null($level) ? 0 : (1 << 10);
		$flags2 |= is_null($subscription_until_date) ? 0 : (1 << 11);
		$flags2 |= is_null($bot_verification_icon) ? 0 : (1 << 13);
		$flags2 |= is_null($send_paid_messages_stars) ? 0 : (1 << 14);
		$flags2 |= is_null($linked_monoforum_id) ? 0 : (1 << 18);
		$writer->writeInt($flags2);
		$writer->writeLong($id);
		if(is_null($access_hash) === false):
			$writer->writeLong($access_hash);
		endif;
		$writer->tgwriteBytes($title);
		if(is_null($username) === false):
			$writer->tgwriteBytes($username);
		endif;
		$writer->write($photo->read());
		$writer->writeInt($date);
		if(is_null($restriction_reason) === false):
			$writer->tgwriteVector($restriction_reason,'RestrictionReason');
		endif;
		if(is_null($admin_rights) === false):
			$writer->write($admin_rights->read());
		endif;
		if(is_null($banned_rights) === false):
			$writer->write($banned_rights->read());
		endif;
		if(is_null($default_banned_rights) === false):
			$writer->write($default_banned_rights->read());
		endif;
		if(is_null($participants_count) === false):
			$writer->writeInt($participants_count);
		endif;
		if(is_null($usernames) === false):
			$writer->tgwriteVector($usernames,'Username');
		endif;
		if(is_null($stories_max_id) === false):
			$writer->writeInt($stories_max_id);
		endif;
		if(is_null($color) === false):
			$writer->write($color->read());
		endif;
		if(is_null($profile_color) === false):
			$writer->write($profile_color->read());
		endif;
		if(is_null($emoji_status) === false):
			$writer->write($emoji_status->read());
		endif;
		if(is_null($level) === false):
			$writer->writeInt($level);
		endif;
		if(is_null($subscription_until_date) === false):
			$writer->writeInt($subscription_until_date);
		endif;
		if(is_null($bot_verification_icon) === false):
			$writer->writeLong($bot_verification_icon);
		endif;
		if(is_null($send_paid_messages_stars) === false):
			$writer->writeLong($send_paid_messages_stars);
		endif;
		if(is_null($linked_monoforum_id) === false):
			$writer->writeLong($linked_monoforum_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['creator'] = true;
		else:
			$result['creator'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['left'] = true;
		else:
			$result['left'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['broadcast'] = true;
		else:
			$result['broadcast'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['verified'] = true;
		else:
			$result['verified'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['megagroup'] = true;
		else:
			$result['megagroup'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['restricted'] = true;
		else:
			$result['restricted'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['signatures'] = true;
		else:
			$result['signatures'] = false;
		endif;
		if($flags & (1 << 12)):
			$result['min'] = true;
		else:
			$result['min'] = false;
		endif;
		if($flags & (1 << 19)):
			$result['scam'] = true;
		else:
			$result['scam'] = false;
		endif;
		if($flags & (1 << 20)):
			$result['has_link'] = true;
		else:
			$result['has_link'] = false;
		endif;
		if($flags & (1 << 21)):
			$result['has_geo'] = true;
		else:
			$result['has_geo'] = false;
		endif;
		if($flags & (1 << 22)):
			$result['slowmode_enabled'] = true;
		else:
			$result['slowmode_enabled'] = false;
		endif;
		if($flags & (1 << 23)):
			$result['call_active'] = true;
		else:
			$result['call_active'] = false;
		endif;
		if($flags & (1 << 24)):
			$result['call_not_empty'] = true;
		else:
			$result['call_not_empty'] = false;
		endif;
		if($flags & (1 << 25)):
			$result['fake'] = true;
		else:
			$result['fake'] = false;
		endif;
		if($flags & (1 << 26)):
			$result['gigagroup'] = true;
		else:
			$result['gigagroup'] = false;
		endif;
		if($flags & (1 << 27)):
			$result['noforwards'] = true;
		else:
			$result['noforwards'] = false;
		endif;
		if($flags & (1 << 28)):
			$result['join_to_send'] = true;
		else:
			$result['join_to_send'] = false;
		endif;
		if($flags & (1 << 29)):
			$result['join_request'] = true;
		else:
			$result['join_request'] = false;
		endif;
		if($flags & (1 << 30)):
			$result['forum'] = true;
		else:
			$result['forum'] = false;
		endif;
		$flags2 = $reader->readInt();
		if($flags2 & (1 << 1)):
			$result['stories_hidden'] = true;
		else:
			$result['stories_hidden'] = false;
		endif;
		if($flags2 & (1 << 2)):
			$result['stories_hidden_min'] = true;
		else:
			$result['stories_hidden_min'] = false;
		endif;
		if($flags2 & (1 << 3)):
			$result['stories_unavailable'] = true;
		else:
			$result['stories_unavailable'] = false;
		endif;
		if($flags2 & (1 << 12)):
			$result['signature_profiles'] = true;
		else:
			$result['signature_profiles'] = false;
		endif;
		if($flags2 & (1 << 15)):
			$result['autotranslation'] = true;
		else:
			$result['autotranslation'] = false;
		endif;
		if($flags2 & (1 << 16)):
			$result['broadcast_messages_allowed'] = true;
		else:
			$result['broadcast_messages_allowed'] = false;
		endif;
		if($flags2 & (1 << 17)):
			$result['monoforum'] = true;
		else:
			$result['monoforum'] = false;
		endif;
		if($flags2 & (1 << 19)):
			$result['forum_tabs'] = true;
		else:
			$result['forum_tabs'] = false;
		endif;
		$result['id'] = $reader->readLong();
		if($flags & (1 << 13)):
			$result['access_hash'] = $reader->readLong();
		else:
			$result['access_hash'] = null;
		endif;
		$result['title'] = $reader->tgreadBytes();
		if($flags & (1 << 6)):
			$result['username'] = $reader->tgreadBytes();
		else:
			$result['username'] = null;
		endif;
		$result['photo'] = $reader->tgreadObject();
		$result['date'] = $reader->readInt();
		if($flags & (1 << 9)):
			$result['restriction_reason'] = $reader->tgreadVector('RestrictionReason');
		else:
			$result['restriction_reason'] = null;
		endif;
		if($flags & (1 << 14)):
			$result['admin_rights'] = $reader->tgreadObject();
		else:
			$result['admin_rights'] = null;
		endif;
		if($flags & (1 << 15)):
			$result['banned_rights'] = $reader->tgreadObject();
		else:
			$result['banned_rights'] = null;
		endif;
		if($flags & (1 << 18)):
			$result['default_banned_rights'] = $reader->tgreadObject();
		else:
			$result['default_banned_rights'] = null;
		endif;
		if($flags & (1 << 17)):
			$result['participants_count'] = $reader->readInt();
		else:
			$result['participants_count'] = null;
		endif;
		if($flags2 & (1 << 0)):
			$result['usernames'] = $reader->tgreadVector('Username');
		else:
			$result['usernames'] = null;
		endif;
		if($flags2 & (1 << 4)):
			$result['stories_max_id'] = $reader->readInt();
		else:
			$result['stories_max_id'] = null;
		endif;
		if($flags2 & (1 << 7)):
			$result['color'] = $reader->tgreadObject();
		else:
			$result['color'] = null;
		endif;
		if($flags2 & (1 << 8)):
			$result['profile_color'] = $reader->tgreadObject();
		else:
			$result['profile_color'] = null;
		endif;
		if($flags2 & (1 << 9)):
			$result['emoji_status'] = $reader->tgreadObject();
		else:
			$result['emoji_status'] = null;
		endif;
		if($flags2 & (1 << 10)):
			$result['level'] = $reader->readInt();
		else:
			$result['level'] = null;
		endif;
		if($flags2 & (1 << 11)):
			$result['subscription_until_date'] = $reader->readInt();
		else:
			$result['subscription_until_date'] = null;
		endif;
		if($flags2 & (1 << 13)):
			$result['bot_verification_icon'] = $reader->readLong();
		else:
			$result['bot_verification_icon'] = null;
		endif;
		if($flags2 & (1 << 14)):
			$result['send_paid_messages_stars'] = $reader->readLong();
		else:
			$result['send_paid_messages_stars'] = null;
		endif;
		if($flags2 & (1 << 18)):
			$result['linked_monoforum_id'] = $reader->readLong();
		else:
			$result['linked_monoforum_id'] = null;
		endif;
		return new self($result);
	}
}

?>