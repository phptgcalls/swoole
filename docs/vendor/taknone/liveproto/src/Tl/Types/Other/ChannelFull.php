<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id string about int read_inbox_max_id int read_outbox_max_id int unread_count photo chat_photo peernotifysettings notify_settings Vector<BotInfo> bot_info int pts true can_view_participants true can_set_username true can_set_stickers true hidden_prehistory true can_set_location true has_scheduled true can_view_stats true blocked true can_delete_channel true antispam true participants_hidden true translations_disabled true stories_pinned_available true view_forum_as_messages true restricted_sponsored true can_view_revenue true paid_media_allowed true can_view_stars_revenue true paid_reactions_available true stargifts_available true paid_messages_available int participants_count int admins_count int kicked_count int banned_count int online_count exportedchatinvite exported_invite long migrated_from_chat_id int migrated_from_max_id int pinned_msg_id stickerset stickerset int available_min_id int folder_id long linked_chat_id channellocation location int slowmode_seconds int slowmode_next_send_date int stats_dc inputgroupcall call int ttl_period Vector<string> pending_suggestions peer groupcall_default_join_as string theme_emoticon int requests_pending Vector<long> recent_requesters peer default_send_as chatreactions available_reactions int reactions_limit peerstories stories wallpaper wallpaper int boosts_applied int boosts_unrestrict stickerset emojiset botverification bot_verification int stargifts_count long send_paid_messages_stars
 * @return ChatFull
 */

final class ChannelFull extends Instance {
	public function request(int $id,string $about,int $read_inbox_max_id,int $read_outbox_max_id,int $unread_count,object $chat_photo,object $notify_settings,array $bot_info,int $pts,? true $can_view_participants = null,? true $can_set_username = null,? true $can_set_stickers = null,? true $hidden_prehistory = null,? true $can_set_location = null,? true $has_scheduled = null,? true $can_view_stats = null,? true $blocked = null,? true $can_delete_channel = null,? true $antispam = null,? true $participants_hidden = null,? true $translations_disabled = null,? true $stories_pinned_available = null,? true $view_forum_as_messages = null,? true $restricted_sponsored = null,? true $can_view_revenue = null,? true $paid_media_allowed = null,? true $can_view_stars_revenue = null,? true $paid_reactions_available = null,? true $stargifts_available = null,? true $paid_messages_available = null,? int $participants_count = null,? int $admins_count = null,? int $kicked_count = null,? int $banned_count = null,? int $online_count = null,? object $exported_invite = null,? int $migrated_from_chat_id = null,? int $migrated_from_max_id = null,? int $pinned_msg_id = null,? object $stickerset = null,? int $available_min_id = null,? int $folder_id = null,? int $linked_chat_id = null,? object $location = null,? int $slowmode_seconds = null,? int $slowmode_next_send_date = null,? int $stats_dc = null,? object $call = null,? int $ttl_period = null,? array $pending_suggestions = null,? object $groupcall_default_join_as = null,? string $theme_emoticon = null,? int $requests_pending = null,? array $recent_requesters = null,? object $default_send_as = null,? object $available_reactions = null,? int $reactions_limit = null,? object $stories = null,? object $wallpaper = null,? int $boosts_applied = null,? int $boosts_unrestrict = null,? object $emojiset = null,? object $bot_verification = null,? int $stargifts_count = null,? int $send_paid_messages_stars = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe07429de);
		$flags = 0;
		$flags |= is_null($can_view_participants) ? 0 : (1 << 3);
		$flags |= is_null($can_set_username) ? 0 : (1 << 6);
		$flags |= is_null($can_set_stickers) ? 0 : (1 << 7);
		$flags |= is_null($hidden_prehistory) ? 0 : (1 << 10);
		$flags |= is_null($can_set_location) ? 0 : (1 << 16);
		$flags |= is_null($has_scheduled) ? 0 : (1 << 19);
		$flags |= is_null($can_view_stats) ? 0 : (1 << 20);
		$flags |= is_null($blocked) ? 0 : (1 << 22);
		$flags |= is_null($participants_count) ? 0 : (1 << 0);
		$flags |= is_null($admins_count) ? 0 : (1 << 1);
		$flags |= is_null($kicked_count) ? 0 : (1 << 2);
		$flags |= is_null($banned_count) ? 0 : (1 << 2);
		$flags |= is_null($online_count) ? 0 : (1 << 13);
		$flags |= is_null($exported_invite) ? 0 : (1 << 23);
		$flags |= is_null($migrated_from_chat_id) ? 0 : (1 << 4);
		$flags |= is_null($migrated_from_max_id) ? 0 : (1 << 4);
		$flags |= is_null($pinned_msg_id) ? 0 : (1 << 5);
		$flags |= is_null($stickerset) ? 0 : (1 << 8);
		$flags |= is_null($available_min_id) ? 0 : (1 << 9);
		$flags |= is_null($folder_id) ? 0 : (1 << 11);
		$flags |= is_null($linked_chat_id) ? 0 : (1 << 14);
		$flags |= is_null($location) ? 0 : (1 << 15);
		$flags |= is_null($slowmode_seconds) ? 0 : (1 << 17);
		$flags |= is_null($slowmode_next_send_date) ? 0 : (1 << 18);
		$flags |= is_null($stats_dc) ? 0 : (1 << 12);
		$flags |= is_null($call) ? 0 : (1 << 21);
		$flags |= is_null($ttl_period) ? 0 : (1 << 24);
		$flags |= is_null($pending_suggestions) ? 0 : (1 << 25);
		$flags |= is_null($groupcall_default_join_as) ? 0 : (1 << 26);
		$flags |= is_null($theme_emoticon) ? 0 : (1 << 27);
		$flags |= is_null($requests_pending) ? 0 : (1 << 28);
		$flags |= is_null($recent_requesters) ? 0 : (1 << 28);
		$flags |= is_null($default_send_as) ? 0 : (1 << 29);
		$flags |= is_null($available_reactions) ? 0 : (1 << 30);
		$writer->writeInt($flags);
		$flags2 = 0;
		$flags2 |= is_null($can_delete_channel) ? 0 : (1 << 0);
		$flags2 |= is_null($antispam) ? 0 : (1 << 1);
		$flags2 |= is_null($participants_hidden) ? 0 : (1 << 2);
		$flags2 |= is_null($translations_disabled) ? 0 : (1 << 3);
		$flags2 |= is_null($stories_pinned_available) ? 0 : (1 << 5);
		$flags2 |= is_null($view_forum_as_messages) ? 0 : (1 << 6);
		$flags2 |= is_null($restricted_sponsored) ? 0 : (1 << 11);
		$flags2 |= is_null($can_view_revenue) ? 0 : (1 << 12);
		$flags2 |= is_null($paid_media_allowed) ? 0 : (1 << 14);
		$flags2 |= is_null($can_view_stars_revenue) ? 0 : (1 << 15);
		$flags2 |= is_null($paid_reactions_available) ? 0 : (1 << 16);
		$flags2 |= is_null($stargifts_available) ? 0 : (1 << 19);
		$flags2 |= is_null($paid_messages_available) ? 0 : (1 << 20);
		$flags2 |= is_null($reactions_limit) ? 0 : (1 << 13);
		$flags2 |= is_null($stories) ? 0 : (1 << 4);
		$flags2 |= is_null($wallpaper) ? 0 : (1 << 7);
		$flags2 |= is_null($boosts_applied) ? 0 : (1 << 8);
		$flags2 |= is_null($boosts_unrestrict) ? 0 : (1 << 9);
		$flags2 |= is_null($emojiset) ? 0 : (1 << 10);
		$flags2 |= is_null($bot_verification) ? 0 : (1 << 17);
		$flags2 |= is_null($stargifts_count) ? 0 : (1 << 18);
		$flags2 |= is_null($send_paid_messages_stars) ? 0 : (1 << 21);
		$writer->writeInt($flags2);
		$writer->writeLong($id);
		$writer->tgwriteBytes($about);
		if(is_null($participants_count) === false):
			$writer->writeInt($participants_count);
		endif;
		if(is_null($admins_count) === false):
			$writer->writeInt($admins_count);
		endif;
		if(is_null($kicked_count) === false):
			$writer->writeInt($kicked_count);
		endif;
		if(is_null($banned_count) === false):
			$writer->writeInt($banned_count);
		endif;
		if(is_null($online_count) === false):
			$writer->writeInt($online_count);
		endif;
		$writer->writeInt($read_inbox_max_id);
		$writer->writeInt($read_outbox_max_id);
		$writer->writeInt($unread_count);
		$writer->write($chat_photo->read());
		$writer->write($notify_settings->read());
		if(is_null($exported_invite) === false):
			$writer->write($exported_invite->read());
		endif;
		$writer->tgwriteVector($bot_info,'BotInfo');
		if(is_null($migrated_from_chat_id) === false):
			$writer->writeLong($migrated_from_chat_id);
		endif;
		if(is_null($migrated_from_max_id) === false):
			$writer->writeInt($migrated_from_max_id);
		endif;
		if(is_null($pinned_msg_id) === false):
			$writer->writeInt($pinned_msg_id);
		endif;
		if(is_null($stickerset) === false):
			$writer->write($stickerset->read());
		endif;
		if(is_null($available_min_id) === false):
			$writer->writeInt($available_min_id);
		endif;
		if(is_null($folder_id) === false):
			$writer->writeInt($folder_id);
		endif;
		if(is_null($linked_chat_id) === false):
			$writer->writeLong($linked_chat_id);
		endif;
		if(is_null($location) === false):
			$writer->write($location->read());
		endif;
		if(is_null($slowmode_seconds) === false):
			$writer->writeInt($slowmode_seconds);
		endif;
		if(is_null($slowmode_next_send_date) === false):
			$writer->writeInt($slowmode_next_send_date);
		endif;
		if(is_null($stats_dc) === false):
			$writer->writeInt($stats_dc);
		endif;
		$writer->writeInt($pts);
		if(is_null($call) === false):
			$writer->write($call->read());
		endif;
		if(is_null($ttl_period) === false):
			$writer->writeInt($ttl_period);
		endif;
		if(is_null($pending_suggestions) === false):
			$writer->tgwriteVector($pending_suggestions,'string');
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
		if(is_null($default_send_as) === false):
			$writer->write($default_send_as->read());
		endif;
		if(is_null($available_reactions) === false):
			$writer->write($available_reactions->read());
		endif;
		if(is_null($reactions_limit) === false):
			$writer->writeInt($reactions_limit);
		endif;
		if(is_null($stories) === false):
			$writer->write($stories->read());
		endif;
		if(is_null($wallpaper) === false):
			$writer->write($wallpaper->read());
		endif;
		if(is_null($boosts_applied) === false):
			$writer->writeInt($boosts_applied);
		endif;
		if(is_null($boosts_unrestrict) === false):
			$writer->writeInt($boosts_unrestrict);
		endif;
		if(is_null($emojiset) === false):
			$writer->write($emojiset->read());
		endif;
		if(is_null($bot_verification) === false):
			$writer->write($bot_verification->read());
		endif;
		if(is_null($stargifts_count) === false):
			$writer->writeInt($stargifts_count);
		endif;
		if(is_null($send_paid_messages_stars) === false):
			$writer->writeLong($send_paid_messages_stars);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 3)):
			$result['can_view_participants'] = true;
		else:
			$result['can_view_participants'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['can_set_username'] = true;
		else:
			$result['can_set_username'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['can_set_stickers'] = true;
		else:
			$result['can_set_stickers'] = false;
		endif;
		if($flags & (1 << 10)):
			$result['hidden_prehistory'] = true;
		else:
			$result['hidden_prehistory'] = false;
		endif;
		if($flags & (1 << 16)):
			$result['can_set_location'] = true;
		else:
			$result['can_set_location'] = false;
		endif;
		if($flags & (1 << 19)):
			$result['has_scheduled'] = true;
		else:
			$result['has_scheduled'] = false;
		endif;
		if($flags & (1 << 20)):
			$result['can_view_stats'] = true;
		else:
			$result['can_view_stats'] = false;
		endif;
		if($flags & (1 << 22)):
			$result['blocked'] = true;
		else:
			$result['blocked'] = false;
		endif;
		$flags2 = $reader->readInt();
		if($flags2 & (1 << 0)):
			$result['can_delete_channel'] = true;
		else:
			$result['can_delete_channel'] = false;
		endif;
		if($flags2 & (1 << 1)):
			$result['antispam'] = true;
		else:
			$result['antispam'] = false;
		endif;
		if($flags2 & (1 << 2)):
			$result['participants_hidden'] = true;
		else:
			$result['participants_hidden'] = false;
		endif;
		if($flags2 & (1 << 3)):
			$result['translations_disabled'] = true;
		else:
			$result['translations_disabled'] = false;
		endif;
		if($flags2 & (1 << 5)):
			$result['stories_pinned_available'] = true;
		else:
			$result['stories_pinned_available'] = false;
		endif;
		if($flags2 & (1 << 6)):
			$result['view_forum_as_messages'] = true;
		else:
			$result['view_forum_as_messages'] = false;
		endif;
		if($flags2 & (1 << 11)):
			$result['restricted_sponsored'] = true;
		else:
			$result['restricted_sponsored'] = false;
		endif;
		if($flags2 & (1 << 12)):
			$result['can_view_revenue'] = true;
		else:
			$result['can_view_revenue'] = false;
		endif;
		if($flags2 & (1 << 14)):
			$result['paid_media_allowed'] = true;
		else:
			$result['paid_media_allowed'] = false;
		endif;
		if($flags2 & (1 << 15)):
			$result['can_view_stars_revenue'] = true;
		else:
			$result['can_view_stars_revenue'] = false;
		endif;
		if($flags2 & (1 << 16)):
			$result['paid_reactions_available'] = true;
		else:
			$result['paid_reactions_available'] = false;
		endif;
		if($flags2 & (1 << 19)):
			$result['stargifts_available'] = true;
		else:
			$result['stargifts_available'] = false;
		endif;
		if($flags2 & (1 << 20)):
			$result['paid_messages_available'] = true;
		else:
			$result['paid_messages_available'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['about'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['participants_count'] = $reader->readInt();
		else:
			$result['participants_count'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['admins_count'] = $reader->readInt();
		else:
			$result['admins_count'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['kicked_count'] = $reader->readInt();
		else:
			$result['kicked_count'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['banned_count'] = $reader->readInt();
		else:
			$result['banned_count'] = null;
		endif;
		if($flags & (1 << 13)):
			$result['online_count'] = $reader->readInt();
		else:
			$result['online_count'] = null;
		endif;
		$result['read_inbox_max_id'] = $reader->readInt();
		$result['read_outbox_max_id'] = $reader->readInt();
		$result['unread_count'] = $reader->readInt();
		$result['chat_photo'] = $reader->tgreadObject();
		$result['notify_settings'] = $reader->tgreadObject();
		if($flags & (1 << 23)):
			$result['exported_invite'] = $reader->tgreadObject();
		else:
			$result['exported_invite'] = null;
		endif;
		$result['bot_info'] = $reader->tgreadVector('BotInfo');
		if($flags & (1 << 4)):
			$result['migrated_from_chat_id'] = $reader->readLong();
		else:
			$result['migrated_from_chat_id'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['migrated_from_max_id'] = $reader->readInt();
		else:
			$result['migrated_from_max_id'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['pinned_msg_id'] = $reader->readInt();
		else:
			$result['pinned_msg_id'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['stickerset'] = $reader->tgreadObject();
		else:
			$result['stickerset'] = null;
		endif;
		if($flags & (1 << 9)):
			$result['available_min_id'] = $reader->readInt();
		else:
			$result['available_min_id'] = null;
		endif;
		if($flags & (1 << 11)):
			$result['folder_id'] = $reader->readInt();
		else:
			$result['folder_id'] = null;
		endif;
		if($flags & (1 << 14)):
			$result['linked_chat_id'] = $reader->readLong();
		else:
			$result['linked_chat_id'] = null;
		endif;
		if($flags & (1 << 15)):
			$result['location'] = $reader->tgreadObject();
		else:
			$result['location'] = null;
		endif;
		if($flags & (1 << 17)):
			$result['slowmode_seconds'] = $reader->readInt();
		else:
			$result['slowmode_seconds'] = null;
		endif;
		if($flags & (1 << 18)):
			$result['slowmode_next_send_date'] = $reader->readInt();
		else:
			$result['slowmode_next_send_date'] = null;
		endif;
		if($flags & (1 << 12)):
			$result['stats_dc'] = $reader->readInt();
		else:
			$result['stats_dc'] = null;
		endif;
		$result['pts'] = $reader->readInt();
		if($flags & (1 << 21)):
			$result['call'] = $reader->tgreadObject();
		else:
			$result['call'] = null;
		endif;
		if($flags & (1 << 24)):
			$result['ttl_period'] = $reader->readInt();
		else:
			$result['ttl_period'] = null;
		endif;
		if($flags & (1 << 25)):
			$result['pending_suggestions'] = $reader->tgreadVector('string');
		else:
			$result['pending_suggestions'] = null;
		endif;
		if($flags & (1 << 26)):
			$result['groupcall_default_join_as'] = $reader->tgreadObject();
		else:
			$result['groupcall_default_join_as'] = null;
		endif;
		if($flags & (1 << 27)):
			$result['theme_emoticon'] = $reader->tgreadBytes();
		else:
			$result['theme_emoticon'] = null;
		endif;
		if($flags & (1 << 28)):
			$result['requests_pending'] = $reader->readInt();
		else:
			$result['requests_pending'] = null;
		endif;
		if($flags & (1 << 28)):
			$result['recent_requesters'] = $reader->tgreadVector('long');
		else:
			$result['recent_requesters'] = null;
		endif;
		if($flags & (1 << 29)):
			$result['default_send_as'] = $reader->tgreadObject();
		else:
			$result['default_send_as'] = null;
		endif;
		if($flags & (1 << 30)):
			$result['available_reactions'] = $reader->tgreadObject();
		else:
			$result['available_reactions'] = null;
		endif;
		if($flags2 & (1 << 13)):
			$result['reactions_limit'] = $reader->readInt();
		else:
			$result['reactions_limit'] = null;
		endif;
		if($flags2 & (1 << 4)):
			$result['stories'] = $reader->tgreadObject();
		else:
			$result['stories'] = null;
		endif;
		if($flags2 & (1 << 7)):
			$result['wallpaper'] = $reader->tgreadObject();
		else:
			$result['wallpaper'] = null;
		endif;
		if($flags2 & (1 << 8)):
			$result['boosts_applied'] = $reader->readInt();
		else:
			$result['boosts_applied'] = null;
		endif;
		if($flags2 & (1 << 9)):
			$result['boosts_unrestrict'] = $reader->readInt();
		else:
			$result['boosts_unrestrict'] = null;
		endif;
		if($flags2 & (1 << 10)):
			$result['emojiset'] = $reader->tgreadObject();
		else:
			$result['emojiset'] = null;
		endif;
		if($flags2 & (1 << 17)):
			$result['bot_verification'] = $reader->tgreadObject();
		else:
			$result['bot_verification'] = null;
		endif;
		if($flags2 & (1 << 18)):
			$result['stargifts_count'] = $reader->readInt();
		else:
			$result['stargifts_count'] = null;
		endif;
		if($flags2 & (1 << 21)):
			$result['send_paid_messages_stars'] = $reader->readLong();
		else:
			$result['send_paid_messages_stars'] = null;
		endif;
		return new self($result);
	}
}

?>