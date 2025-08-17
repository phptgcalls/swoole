<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id true self true contact true mutual_contact true deleted true bot true bot_chat_history true bot_nochats true verified true restricted true min true bot_inline_geo true support true scam true apply_min_photo true fake true bot_attach_menu true premium true attach_menu_enabled true bot_can_edit true close_friend true stories_hidden true stories_unavailable true contact_require_premium true bot_business true bot_has_main_app long access_hash string first_name string last_name string username string phone userprofilephoto photo userstatus status int bot_info_version Vector<RestrictionReason> restriction_reason string bot_inline_placeholder string lang_code emojistatus emoji_status Vector<Username> usernames int stories_max_id peercolor color peercolor profile_color int bot_active_users long bot_verification_icon long send_paid_messages_stars
 * @return User
 */

final class User extends Instance {
	public function request(int $id,? true $self = null,? true $contact = null,? true $mutual_contact = null,? true $deleted = null,? true $bot = null,? true $bot_chat_history = null,? true $bot_nochats = null,? true $verified = null,? true $restricted = null,? true $min = null,? true $bot_inline_geo = null,? true $support = null,? true $scam = null,? true $apply_min_photo = null,? true $fake = null,? true $bot_attach_menu = null,? true $premium = null,? true $attach_menu_enabled = null,? true $bot_can_edit = null,? true $close_friend = null,? true $stories_hidden = null,? true $stories_unavailable = null,? true $contact_require_premium = null,? true $bot_business = null,? true $bot_has_main_app = null,? int $access_hash = null,? string $first_name = null,? string $last_name = null,? string $username = null,? string $phone = null,? object $photo = null,? object $status = null,? int $bot_info_version = null,? array $restriction_reason = null,? string $bot_inline_placeholder = null,? string $lang_code = null,? object $emoji_status = null,? array $usernames = null,? int $stories_max_id = null,? object $color = null,? object $profile_color = null,? int $bot_active_users = null,? int $bot_verification_icon = null,? int $send_paid_messages_stars = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x20b1422);
		$flags = 0;
		$flags |= is_null($self) ? 0 : (1 << 10);
		$flags |= is_null($contact) ? 0 : (1 << 11);
		$flags |= is_null($mutual_contact) ? 0 : (1 << 12);
		$flags |= is_null($deleted) ? 0 : (1 << 13);
		$flags |= is_null($bot) ? 0 : (1 << 14);
		$flags |= is_null($bot_chat_history) ? 0 : (1 << 15);
		$flags |= is_null($bot_nochats) ? 0 : (1 << 16);
		$flags |= is_null($verified) ? 0 : (1 << 17);
		$flags |= is_null($restricted) ? 0 : (1 << 18);
		$flags |= is_null($min) ? 0 : (1 << 20);
		$flags |= is_null($bot_inline_geo) ? 0 : (1 << 21);
		$flags |= is_null($support) ? 0 : (1 << 23);
		$flags |= is_null($scam) ? 0 : (1 << 24);
		$flags |= is_null($apply_min_photo) ? 0 : (1 << 25);
		$flags |= is_null($fake) ? 0 : (1 << 26);
		$flags |= is_null($bot_attach_menu) ? 0 : (1 << 27);
		$flags |= is_null($premium) ? 0 : (1 << 28);
		$flags |= is_null($attach_menu_enabled) ? 0 : (1 << 29);
		$flags |= is_null($access_hash) ? 0 : (1 << 0);
		$flags |= is_null($first_name) ? 0 : (1 << 1);
		$flags |= is_null($last_name) ? 0 : (1 << 2);
		$flags |= is_null($username) ? 0 : (1 << 3);
		$flags |= is_null($phone) ? 0 : (1 << 4);
		$flags |= is_null($photo) ? 0 : (1 << 5);
		$flags |= is_null($status) ? 0 : (1 << 6);
		$flags |= is_null($bot_info_version) ? 0 : (1 << 14);
		$flags |= is_null($restriction_reason) ? 0 : (1 << 18);
		$flags |= is_null($bot_inline_placeholder) ? 0 : (1 << 19);
		$flags |= is_null($lang_code) ? 0 : (1 << 22);
		$flags |= is_null($emoji_status) ? 0 : (1 << 30);
		$writer->writeInt($flags);
		$flags2 = 0;
		$flags2 |= is_null($bot_can_edit) ? 0 : (1 << 1);
		$flags2 |= is_null($close_friend) ? 0 : (1 << 2);
		$flags2 |= is_null($stories_hidden) ? 0 : (1 << 3);
		$flags2 |= is_null($stories_unavailable) ? 0 : (1 << 4);
		$flags2 |= is_null($contact_require_premium) ? 0 : (1 << 10);
		$flags2 |= is_null($bot_business) ? 0 : (1 << 11);
		$flags2 |= is_null($bot_has_main_app) ? 0 : (1 << 13);
		$flags2 |= is_null($usernames) ? 0 : (1 << 0);
		$flags2 |= is_null($stories_max_id) ? 0 : (1 << 5);
		$flags2 |= is_null($color) ? 0 : (1 << 8);
		$flags2 |= is_null($profile_color) ? 0 : (1 << 9);
		$flags2 |= is_null($bot_active_users) ? 0 : (1 << 12);
		$flags2 |= is_null($bot_verification_icon) ? 0 : (1 << 14);
		$flags2 |= is_null($send_paid_messages_stars) ? 0 : (1 << 15);
		$writer->writeInt($flags2);
		$writer->writeLong($id);
		if(is_null($access_hash) === false):
			$writer->writeLong($access_hash);
		endif;
		if(is_null($first_name) === false):
			$writer->tgwriteBytes($first_name);
		endif;
		if(is_null($last_name) === false):
			$writer->tgwriteBytes($last_name);
		endif;
		if(is_null($username) === false):
			$writer->tgwriteBytes($username);
		endif;
		if(is_null($phone) === false):
			$writer->tgwriteBytes($phone);
		endif;
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		if(is_null($status) === false):
			$writer->write($status->read());
		endif;
		if(is_null($bot_info_version) === false):
			$writer->writeInt($bot_info_version);
		endif;
		if(is_null($restriction_reason) === false):
			$writer->tgwriteVector($restriction_reason,'RestrictionReason');
		endif;
		if(is_null($bot_inline_placeholder) === false):
			$writer->tgwriteBytes($bot_inline_placeholder);
		endif;
		if(is_null($lang_code) === false):
			$writer->tgwriteBytes($lang_code);
		endif;
		if(is_null($emoji_status) === false):
			$writer->write($emoji_status->read());
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
		if(is_null($bot_active_users) === false):
			$writer->writeInt($bot_active_users);
		endif;
		if(is_null($bot_verification_icon) === false):
			$writer->writeLong($bot_verification_icon);
		endif;
		if(is_null($send_paid_messages_stars) === false):
			$writer->writeLong($send_paid_messages_stars);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 10)):
			$result['self'] = true;
		else:
			$result['self'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['contact'] = true;
		else:
			$result['contact'] = false;
		endif;
		if($flags & (1 << 12)):
			$result['mutual_contact'] = true;
		else:
			$result['mutual_contact'] = false;
		endif;
		if($flags & (1 << 13)):
			$result['deleted'] = true;
		else:
			$result['deleted'] = false;
		endif;
		if($flags & (1 << 14)):
			$result['bot'] = true;
		else:
			$result['bot'] = false;
		endif;
		if($flags & (1 << 15)):
			$result['bot_chat_history'] = true;
		else:
			$result['bot_chat_history'] = false;
		endif;
		if($flags & (1 << 16)):
			$result['bot_nochats'] = true;
		else:
			$result['bot_nochats'] = false;
		endif;
		if($flags & (1 << 17)):
			$result['verified'] = true;
		else:
			$result['verified'] = false;
		endif;
		if($flags & (1 << 18)):
			$result['restricted'] = true;
		else:
			$result['restricted'] = false;
		endif;
		if($flags & (1 << 20)):
			$result['min'] = true;
		else:
			$result['min'] = false;
		endif;
		if($flags & (1 << 21)):
			$result['bot_inline_geo'] = true;
		else:
			$result['bot_inline_geo'] = false;
		endif;
		if($flags & (1 << 23)):
			$result['support'] = true;
		else:
			$result['support'] = false;
		endif;
		if($flags & (1 << 24)):
			$result['scam'] = true;
		else:
			$result['scam'] = false;
		endif;
		if($flags & (1 << 25)):
			$result['apply_min_photo'] = true;
		else:
			$result['apply_min_photo'] = false;
		endif;
		if($flags & (1 << 26)):
			$result['fake'] = true;
		else:
			$result['fake'] = false;
		endif;
		if($flags & (1 << 27)):
			$result['bot_attach_menu'] = true;
		else:
			$result['bot_attach_menu'] = false;
		endif;
		if($flags & (1 << 28)):
			$result['premium'] = true;
		else:
			$result['premium'] = false;
		endif;
		if($flags & (1 << 29)):
			$result['attach_menu_enabled'] = true;
		else:
			$result['attach_menu_enabled'] = false;
		endif;
		$flags2 = $reader->readInt();
		if($flags2 & (1 << 1)):
			$result['bot_can_edit'] = true;
		else:
			$result['bot_can_edit'] = false;
		endif;
		if($flags2 & (1 << 2)):
			$result['close_friend'] = true;
		else:
			$result['close_friend'] = false;
		endif;
		if($flags2 & (1 << 3)):
			$result['stories_hidden'] = true;
		else:
			$result['stories_hidden'] = false;
		endif;
		if($flags2 & (1 << 4)):
			$result['stories_unavailable'] = true;
		else:
			$result['stories_unavailable'] = false;
		endif;
		if($flags2 & (1 << 10)):
			$result['contact_require_premium'] = true;
		else:
			$result['contact_require_premium'] = false;
		endif;
		if($flags2 & (1 << 11)):
			$result['bot_business'] = true;
		else:
			$result['bot_business'] = false;
		endif;
		if($flags2 & (1 << 13)):
			$result['bot_has_main_app'] = true;
		else:
			$result['bot_has_main_app'] = false;
		endif;
		$result['id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['access_hash'] = $reader->readLong();
		else:
			$result['access_hash'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['first_name'] = $reader->tgreadBytes();
		else:
			$result['first_name'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['last_name'] = $reader->tgreadBytes();
		else:
			$result['last_name'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['username'] = $reader->tgreadBytes();
		else:
			$result['username'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['phone'] = $reader->tgreadBytes();
		else:
			$result['phone'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['status'] = $reader->tgreadObject();
		else:
			$result['status'] = null;
		endif;
		if($flags & (1 << 14)):
			$result['bot_info_version'] = $reader->readInt();
		else:
			$result['bot_info_version'] = null;
		endif;
		if($flags & (1 << 18)):
			$result['restriction_reason'] = $reader->tgreadVector('RestrictionReason');
		else:
			$result['restriction_reason'] = null;
		endif;
		if($flags & (1 << 19)):
			$result['bot_inline_placeholder'] = $reader->tgreadBytes();
		else:
			$result['bot_inline_placeholder'] = null;
		endif;
		if($flags & (1 << 22)):
			$result['lang_code'] = $reader->tgreadBytes();
		else:
			$result['lang_code'] = null;
		endif;
		if($flags & (1 << 30)):
			$result['emoji_status'] = $reader->tgreadObject();
		else:
			$result['emoji_status'] = null;
		endif;
		if($flags2 & (1 << 0)):
			$result['usernames'] = $reader->tgreadVector('Username');
		else:
			$result['usernames'] = null;
		endif;
		if($flags2 & (1 << 5)):
			$result['stories_max_id'] = $reader->readInt();
		else:
			$result['stories_max_id'] = null;
		endif;
		if($flags2 & (1 << 8)):
			$result['color'] = $reader->tgreadObject();
		else:
			$result['color'] = null;
		endif;
		if($flags2 & (1 << 9)):
			$result['profile_color'] = $reader->tgreadObject();
		else:
			$result['profile_color'] = null;
		endif;
		if($flags2 & (1 << 12)):
			$result['bot_active_users'] = $reader->readInt();
		else:
			$result['bot_active_users'] = null;
		endif;
		if($flags2 & (1 << 14)):
			$result['bot_verification_icon'] = $reader->readLong();
		else:
			$result['bot_verification_icon'] = null;
		endif;
		if($flags2 & (1 << 15)):
			$result['send_paid_messages_stars'] = $reader->readLong();
		else:
			$result['send_paid_messages_stars'] = null;
		endif;
		return new self($result);
	}
}

?>