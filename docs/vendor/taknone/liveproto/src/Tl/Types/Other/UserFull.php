<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id peersettings settings peernotifysettings notify_settings int common_chats_count true blocked true phone_calls_available true phone_calls_private true can_pin_message true has_scheduled true video_calls_available true voice_messages_forbidden true translations_disabled true stories_pinned_available true blocked_my_stories_from true wallpaper_overridden true contact_require_premium true read_dates_private true sponsored_enabled true can_view_revenue true bot_can_manage_emoji_status true display_gifts_button string about photo personal_photo photo profile_photo photo fallback_photo botinfo bot_info int pinned_msg_id int folder_id int ttl_period string theme_emoticon string private_forward_name chatadminrights bot_group_admin_rights chatadminrights bot_broadcast_admin_rights wallpaper wallpaper peerstories stories businessworkhours business_work_hours businesslocation business_location businessgreetingmessage business_greeting_message businessawaymessage business_away_message businessintro business_intro birthday birthday long personal_channel_id int personal_channel_message int stargifts_count starrefprogram starref_program botverification bot_verification long send_paid_messages_stars disallowedgiftssettings disallowed_gifts starsrating stars_rating starsrating stars_my_pending_rating int stars_my_pending_rating_date
 * @return UserFull
 */

final class UserFull extends Instance {
	public function request(int $id,object $settings,object $notify_settings,int $common_chats_count,? true $blocked = null,? true $phone_calls_available = null,? true $phone_calls_private = null,? true $can_pin_message = null,? true $has_scheduled = null,? true $video_calls_available = null,? true $voice_messages_forbidden = null,? true $translations_disabled = null,? true $stories_pinned_available = null,? true $blocked_my_stories_from = null,? true $wallpaper_overridden = null,? true $contact_require_premium = null,? true $read_dates_private = null,? true $sponsored_enabled = null,? true $can_view_revenue = null,? true $bot_can_manage_emoji_status = null,? true $display_gifts_button = null,? string $about = null,? object $personal_photo = null,? object $profile_photo = null,? object $fallback_photo = null,? object $bot_info = null,? int $pinned_msg_id = null,? int $folder_id = null,? int $ttl_period = null,? string $theme_emoticon = null,? string $private_forward_name = null,? object $bot_group_admin_rights = null,? object $bot_broadcast_admin_rights = null,? object $wallpaper = null,? object $stories = null,? object $business_work_hours = null,? object $business_location = null,? object $business_greeting_message = null,? object $business_away_message = null,? object $business_intro = null,? object $birthday = null,? int $personal_channel_id = null,? int $personal_channel_message = null,? int $stargifts_count = null,? object $starref_program = null,? object $bot_verification = null,? int $send_paid_messages_stars = null,? object $disallowed_gifts = null,? object $stars_rating = null,? object $stars_my_pending_rating = null,? int $stars_my_pending_rating_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7e63ce1f);
		$flags = 0;
		$flags |= is_null($blocked) ? 0 : (1 << 0);
		$flags |= is_null($phone_calls_available) ? 0 : (1 << 4);
		$flags |= is_null($phone_calls_private) ? 0 : (1 << 5);
		$flags |= is_null($can_pin_message) ? 0 : (1 << 7);
		$flags |= is_null($has_scheduled) ? 0 : (1 << 12);
		$flags |= is_null($video_calls_available) ? 0 : (1 << 13);
		$flags |= is_null($voice_messages_forbidden) ? 0 : (1 << 20);
		$flags |= is_null($translations_disabled) ? 0 : (1 << 23);
		$flags |= is_null($stories_pinned_available) ? 0 : (1 << 26);
		$flags |= is_null($blocked_my_stories_from) ? 0 : (1 << 27);
		$flags |= is_null($wallpaper_overridden) ? 0 : (1 << 28);
		$flags |= is_null($contact_require_premium) ? 0 : (1 << 29);
		$flags |= is_null($read_dates_private) ? 0 : (1 << 30);
		$flags |= is_null($about) ? 0 : (1 << 1);
		$flags |= is_null($personal_photo) ? 0 : (1 << 21);
		$flags |= is_null($profile_photo) ? 0 : (1 << 2);
		$flags |= is_null($fallback_photo) ? 0 : (1 << 22);
		$flags |= is_null($bot_info) ? 0 : (1 << 3);
		$flags |= is_null($pinned_msg_id) ? 0 : (1 << 6);
		$flags |= is_null($folder_id) ? 0 : (1 << 11);
		$flags |= is_null($ttl_period) ? 0 : (1 << 14);
		$flags |= is_null($theme_emoticon) ? 0 : (1 << 15);
		$flags |= is_null($private_forward_name) ? 0 : (1 << 16);
		$flags |= is_null($bot_group_admin_rights) ? 0 : (1 << 17);
		$flags |= is_null($bot_broadcast_admin_rights) ? 0 : (1 << 18);
		$flags |= is_null($wallpaper) ? 0 : (1 << 24);
		$flags |= is_null($stories) ? 0 : (1 << 25);
		$writer->writeInt($flags);
		$flags2 = 0;
		$flags2 |= is_null($sponsored_enabled) ? 0 : (1 << 7);
		$flags2 |= is_null($can_view_revenue) ? 0 : (1 << 9);
		$flags2 |= is_null($bot_can_manage_emoji_status) ? 0 : (1 << 10);
		$flags2 |= is_null($display_gifts_button) ? 0 : (1 << 16);
		$flags2 |= is_null($business_work_hours) ? 0 : (1 << 0);
		$flags2 |= is_null($business_location) ? 0 : (1 << 1);
		$flags2 |= is_null($business_greeting_message) ? 0 : (1 << 2);
		$flags2 |= is_null($business_away_message) ? 0 : (1 << 3);
		$flags2 |= is_null($business_intro) ? 0 : (1 << 4);
		$flags2 |= is_null($birthday) ? 0 : (1 << 5);
		$flags2 |= is_null($personal_channel_id) ? 0 : (1 << 6);
		$flags2 |= is_null($personal_channel_message) ? 0 : (1 << 6);
		$flags2 |= is_null($stargifts_count) ? 0 : (1 << 8);
		$flags2 |= is_null($starref_program) ? 0 : (1 << 11);
		$flags2 |= is_null($bot_verification) ? 0 : (1 << 12);
		$flags2 |= is_null($send_paid_messages_stars) ? 0 : (1 << 14);
		$flags2 |= is_null($disallowed_gifts) ? 0 : (1 << 15);
		$flags2 |= is_null($stars_rating) ? 0 : (1 << 17);
		$flags2 |= is_null($stars_my_pending_rating) ? 0 : (1 << 18);
		$flags2 |= is_null($stars_my_pending_rating_date) ? 0 : (1 << 18);
		$writer->writeInt($flags2);
		$writer->writeLong($id);
		if(is_null($about) === false):
			$writer->tgwriteBytes($about);
		endif;
		$writer->write($settings->read());
		if(is_null($personal_photo) === false):
			$writer->write($personal_photo->read());
		endif;
		if(is_null($profile_photo) === false):
			$writer->write($profile_photo->read());
		endif;
		if(is_null($fallback_photo) === false):
			$writer->write($fallback_photo->read());
		endif;
		$writer->write($notify_settings->read());
		if(is_null($bot_info) === false):
			$writer->write($bot_info->read());
		endif;
		if(is_null($pinned_msg_id) === false):
			$writer->writeInt($pinned_msg_id);
		endif;
		$writer->writeInt($common_chats_count);
		if(is_null($folder_id) === false):
			$writer->writeInt($folder_id);
		endif;
		if(is_null($ttl_period) === false):
			$writer->writeInt($ttl_period);
		endif;
		if(is_null($theme_emoticon) === false):
			$writer->tgwriteBytes($theme_emoticon);
		endif;
		if(is_null($private_forward_name) === false):
			$writer->tgwriteBytes($private_forward_name);
		endif;
		if(is_null($bot_group_admin_rights) === false):
			$writer->write($bot_group_admin_rights->read());
		endif;
		if(is_null($bot_broadcast_admin_rights) === false):
			$writer->write($bot_broadcast_admin_rights->read());
		endif;
		if(is_null($wallpaper) === false):
			$writer->write($wallpaper->read());
		endif;
		if(is_null($stories) === false):
			$writer->write($stories->read());
		endif;
		if(is_null($business_work_hours) === false):
			$writer->write($business_work_hours->read());
		endif;
		if(is_null($business_location) === false):
			$writer->write($business_location->read());
		endif;
		if(is_null($business_greeting_message) === false):
			$writer->write($business_greeting_message->read());
		endif;
		if(is_null($business_away_message) === false):
			$writer->write($business_away_message->read());
		endif;
		if(is_null($business_intro) === false):
			$writer->write($business_intro->read());
		endif;
		if(is_null($birthday) === false):
			$writer->write($birthday->read());
		endif;
		if(is_null($personal_channel_id) === false):
			$writer->writeLong($personal_channel_id);
		endif;
		if(is_null($personal_channel_message) === false):
			$writer->writeInt($personal_channel_message);
		endif;
		if(is_null($stargifts_count) === false):
			$writer->writeInt($stargifts_count);
		endif;
		if(is_null($starref_program) === false):
			$writer->write($starref_program->read());
		endif;
		if(is_null($bot_verification) === false):
			$writer->write($bot_verification->read());
		endif;
		if(is_null($send_paid_messages_stars) === false):
			$writer->writeLong($send_paid_messages_stars);
		endif;
		if(is_null($disallowed_gifts) === false):
			$writer->write($disallowed_gifts->read());
		endif;
		if(is_null($stars_rating) === false):
			$writer->write($stars_rating->read());
		endif;
		if(is_null($stars_my_pending_rating) === false):
			$writer->write($stars_my_pending_rating->read());
		endif;
		if(is_null($stars_my_pending_rating_date) === false):
			$writer->writeInt($stars_my_pending_rating_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['blocked'] = true;
		else:
			$result['blocked'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['phone_calls_available'] = true;
		else:
			$result['phone_calls_available'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['phone_calls_private'] = true;
		else:
			$result['phone_calls_private'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['can_pin_message'] = true;
		else:
			$result['can_pin_message'] = false;
		endif;
		if($flags & (1 << 12)):
			$result['has_scheduled'] = true;
		else:
			$result['has_scheduled'] = false;
		endif;
		if($flags & (1 << 13)):
			$result['video_calls_available'] = true;
		else:
			$result['video_calls_available'] = false;
		endif;
		if($flags & (1 << 20)):
			$result['voice_messages_forbidden'] = true;
		else:
			$result['voice_messages_forbidden'] = false;
		endif;
		if($flags & (1 << 23)):
			$result['translations_disabled'] = true;
		else:
			$result['translations_disabled'] = false;
		endif;
		if($flags & (1 << 26)):
			$result['stories_pinned_available'] = true;
		else:
			$result['stories_pinned_available'] = false;
		endif;
		if($flags & (1 << 27)):
			$result['blocked_my_stories_from'] = true;
		else:
			$result['blocked_my_stories_from'] = false;
		endif;
		if($flags & (1 << 28)):
			$result['wallpaper_overridden'] = true;
		else:
			$result['wallpaper_overridden'] = false;
		endif;
		if($flags & (1 << 29)):
			$result['contact_require_premium'] = true;
		else:
			$result['contact_require_premium'] = false;
		endif;
		if($flags & (1 << 30)):
			$result['read_dates_private'] = true;
		else:
			$result['read_dates_private'] = false;
		endif;
		$flags2 = $reader->readInt();
		if($flags2 & (1 << 7)):
			$result['sponsored_enabled'] = true;
		else:
			$result['sponsored_enabled'] = false;
		endif;
		if($flags2 & (1 << 9)):
			$result['can_view_revenue'] = true;
		else:
			$result['can_view_revenue'] = false;
		endif;
		if($flags2 & (1 << 10)):
			$result['bot_can_manage_emoji_status'] = true;
		else:
			$result['bot_can_manage_emoji_status'] = false;
		endif;
		if($flags2 & (1 << 16)):
			$result['display_gifts_button'] = true;
		else:
			$result['display_gifts_button'] = false;
		endif;
		$result['id'] = $reader->readLong();
		if($flags & (1 << 1)):
			$result['about'] = $reader->tgreadBytes();
		else:
			$result['about'] = null;
		endif;
		$result['settings'] = $reader->tgreadObject();
		if($flags & (1 << 21)):
			$result['personal_photo'] = $reader->tgreadObject();
		else:
			$result['personal_photo'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['profile_photo'] = $reader->tgreadObject();
		else:
			$result['profile_photo'] = null;
		endif;
		if($flags & (1 << 22)):
			$result['fallback_photo'] = $reader->tgreadObject();
		else:
			$result['fallback_photo'] = null;
		endif;
		$result['notify_settings'] = $reader->tgreadObject();
		if($flags & (1 << 3)):
			$result['bot_info'] = $reader->tgreadObject();
		else:
			$result['bot_info'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['pinned_msg_id'] = $reader->readInt();
		else:
			$result['pinned_msg_id'] = null;
		endif;
		$result['common_chats_count'] = $reader->readInt();
		if($flags & (1 << 11)):
			$result['folder_id'] = $reader->readInt();
		else:
			$result['folder_id'] = null;
		endif;
		if($flags & (1 << 14)):
			$result['ttl_period'] = $reader->readInt();
		else:
			$result['ttl_period'] = null;
		endif;
		if($flags & (1 << 15)):
			$result['theme_emoticon'] = $reader->tgreadBytes();
		else:
			$result['theme_emoticon'] = null;
		endif;
		if($flags & (1 << 16)):
			$result['private_forward_name'] = $reader->tgreadBytes();
		else:
			$result['private_forward_name'] = null;
		endif;
		if($flags & (1 << 17)):
			$result['bot_group_admin_rights'] = $reader->tgreadObject();
		else:
			$result['bot_group_admin_rights'] = null;
		endif;
		if($flags & (1 << 18)):
			$result['bot_broadcast_admin_rights'] = $reader->tgreadObject();
		else:
			$result['bot_broadcast_admin_rights'] = null;
		endif;
		if($flags & (1 << 24)):
			$result['wallpaper'] = $reader->tgreadObject();
		else:
			$result['wallpaper'] = null;
		endif;
		if($flags & (1 << 25)):
			$result['stories'] = $reader->tgreadObject();
		else:
			$result['stories'] = null;
		endif;
		if($flags2 & (1 << 0)):
			$result['business_work_hours'] = $reader->tgreadObject();
		else:
			$result['business_work_hours'] = null;
		endif;
		if($flags2 & (1 << 1)):
			$result['business_location'] = $reader->tgreadObject();
		else:
			$result['business_location'] = null;
		endif;
		if($flags2 & (1 << 2)):
			$result['business_greeting_message'] = $reader->tgreadObject();
		else:
			$result['business_greeting_message'] = null;
		endif;
		if($flags2 & (1 << 3)):
			$result['business_away_message'] = $reader->tgreadObject();
		else:
			$result['business_away_message'] = null;
		endif;
		if($flags2 & (1 << 4)):
			$result['business_intro'] = $reader->tgreadObject();
		else:
			$result['business_intro'] = null;
		endif;
		if($flags2 & (1 << 5)):
			$result['birthday'] = $reader->tgreadObject();
		else:
			$result['birthday'] = null;
		endif;
		if($flags2 & (1 << 6)):
			$result['personal_channel_id'] = $reader->readLong();
		else:
			$result['personal_channel_id'] = null;
		endif;
		if($flags2 & (1 << 6)):
			$result['personal_channel_message'] = $reader->readInt();
		else:
			$result['personal_channel_message'] = null;
		endif;
		if($flags2 & (1 << 8)):
			$result['stargifts_count'] = $reader->readInt();
		else:
			$result['stargifts_count'] = null;
		endif;
		if($flags2 & (1 << 11)):
			$result['starref_program'] = $reader->tgreadObject();
		else:
			$result['starref_program'] = null;
		endif;
		if($flags2 & (1 << 12)):
			$result['bot_verification'] = $reader->tgreadObject();
		else:
			$result['bot_verification'] = null;
		endif;
		if($flags2 & (1 << 14)):
			$result['send_paid_messages_stars'] = $reader->readLong();
		else:
			$result['send_paid_messages_stars'] = null;
		endif;
		if($flags2 & (1 << 15)):
			$result['disallowed_gifts'] = $reader->tgreadObject();
		else:
			$result['disallowed_gifts'] = null;
		endif;
		if($flags2 & (1 << 17)):
			$result['stars_rating'] = $reader->tgreadObject();
		else:
			$result['stars_rating'] = null;
		endif;
		if($flags2 & (1 << 18)):
			$result['stars_my_pending_rating'] = $reader->tgreadObject();
		else:
			$result['stars_my_pending_rating'] = null;
		endif;
		if($flags2 & (1 << 18)):
			$result['stars_my_pending_rating_date'] = $reader->readInt();
		else:
			$result['stars_my_pending_rating_date'] = null;
		endif;
		return new self($result);
	}
}

?>