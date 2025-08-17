<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date int expires bool test_mode int this_dc Vector<DcOption> dc_options string dc_txt_domain_name int chat_size_max int megagroup_size_max int forwarded_count_max int online_update_period_ms int offline_blur_timeout_ms int offline_idle_timeout_ms int online_cloud_timeout_ms int notify_cloud_delay_ms int notify_default_delay_ms int push_chat_period_ms int push_chat_limit int edit_time_limit int revoke_time_limit int revoke_pm_time_limit int rating_e_decay int stickers_recent_limit int channels_read_media_period int call_receive_timeout_ms int call_ring_timeout_ms int call_connect_timeout_ms int call_packet_timeout_ms string me_url_prefix int caption_length_max int message_length_max int webfile_dc_id true default_p2p_contacts true preload_featured_stickers true revoke_pm_inbox true blocked_mode true force_try_ipv6 int tmp_sessions string autoupdate_url_prefix string gif_search_username string venue_search_username string img_search_username string static_maps_provider string suggested_lang_code int lang_pack_version int base_lang_pack_version reaction reactions_default string autologin_token
 * @return Config
 */

final class Config extends Instance {
	public function request(int $date,int $expires,bool $test_mode,int $this_dc,array $dc_options,string $dc_txt_domain_name,int $chat_size_max,int $megagroup_size_max,int $forwarded_count_max,int $online_update_period_ms,int $offline_blur_timeout_ms,int $offline_idle_timeout_ms,int $online_cloud_timeout_ms,int $notify_cloud_delay_ms,int $notify_default_delay_ms,int $push_chat_period_ms,int $push_chat_limit,int $edit_time_limit,int $revoke_time_limit,int $revoke_pm_time_limit,int $rating_e_decay,int $stickers_recent_limit,int $channels_read_media_period,int $call_receive_timeout_ms,int $call_ring_timeout_ms,int $call_connect_timeout_ms,int $call_packet_timeout_ms,string $me_url_prefix,int $caption_length_max,int $message_length_max,int $webfile_dc_id,? true $default_p2p_contacts = null,? true $preload_featured_stickers = null,? true $revoke_pm_inbox = null,? true $blocked_mode = null,? true $force_try_ipv6 = null,? int $tmp_sessions = null,? string $autoupdate_url_prefix = null,? string $gif_search_username = null,? string $venue_search_username = null,? string $img_search_username = null,? string $static_maps_provider = null,? string $suggested_lang_code = null,? int $lang_pack_version = null,? int $base_lang_pack_version = null,? object $reactions_default = null,? string $autologin_token = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcc1a241e);
		$flags = 0;
		$flags |= is_null($default_p2p_contacts) ? 0 : (1 << 3);
		$flags |= is_null($preload_featured_stickers) ? 0 : (1 << 4);
		$flags |= is_null($revoke_pm_inbox) ? 0 : (1 << 6);
		$flags |= is_null($blocked_mode) ? 0 : (1 << 8);
		$flags |= is_null($force_try_ipv6) ? 0 : (1 << 14);
		$flags |= is_null($tmp_sessions) ? 0 : (1 << 0);
		$flags |= is_null($autoupdate_url_prefix) ? 0 : (1 << 7);
		$flags |= is_null($gif_search_username) ? 0 : (1 << 9);
		$flags |= is_null($venue_search_username) ? 0 : (1 << 10);
		$flags |= is_null($img_search_username) ? 0 : (1 << 11);
		$flags |= is_null($static_maps_provider) ? 0 : (1 << 12);
		$flags |= is_null($suggested_lang_code) ? 0 : (1 << 2);
		$flags |= is_null($lang_pack_version) ? 0 : (1 << 2);
		$flags |= is_null($base_lang_pack_version) ? 0 : (1 << 2);
		$flags |= is_null($reactions_default) ? 0 : (1 << 15);
		$flags |= is_null($autologin_token) ? 0 : (1 << 16);
		$writer->writeInt($flags);
		$writer->writeInt($date);
		$writer->writeInt($expires);
		$writer->tgwriteBool($test_mode);
		$writer->writeInt($this_dc);
		$writer->tgwriteVector($dc_options,'DcOption');
		$writer->tgwriteBytes($dc_txt_domain_name);
		$writer->writeInt($chat_size_max);
		$writer->writeInt($megagroup_size_max);
		$writer->writeInt($forwarded_count_max);
		$writer->writeInt($online_update_period_ms);
		$writer->writeInt($offline_blur_timeout_ms);
		$writer->writeInt($offline_idle_timeout_ms);
		$writer->writeInt($online_cloud_timeout_ms);
		$writer->writeInt($notify_cloud_delay_ms);
		$writer->writeInt($notify_default_delay_ms);
		$writer->writeInt($push_chat_period_ms);
		$writer->writeInt($push_chat_limit);
		$writer->writeInt($edit_time_limit);
		$writer->writeInt($revoke_time_limit);
		$writer->writeInt($revoke_pm_time_limit);
		$writer->writeInt($rating_e_decay);
		$writer->writeInt($stickers_recent_limit);
		$writer->writeInt($channels_read_media_period);
		if(is_null($tmp_sessions) === false):
			$writer->writeInt($tmp_sessions);
		endif;
		$writer->writeInt($call_receive_timeout_ms);
		$writer->writeInt($call_ring_timeout_ms);
		$writer->writeInt($call_connect_timeout_ms);
		$writer->writeInt($call_packet_timeout_ms);
		$writer->tgwriteBytes($me_url_prefix);
		if(is_null($autoupdate_url_prefix) === false):
			$writer->tgwriteBytes($autoupdate_url_prefix);
		endif;
		if(is_null($gif_search_username) === false):
			$writer->tgwriteBytes($gif_search_username);
		endif;
		if(is_null($venue_search_username) === false):
			$writer->tgwriteBytes($venue_search_username);
		endif;
		if(is_null($img_search_username) === false):
			$writer->tgwriteBytes($img_search_username);
		endif;
		if(is_null($static_maps_provider) === false):
			$writer->tgwriteBytes($static_maps_provider);
		endif;
		$writer->writeInt($caption_length_max);
		$writer->writeInt($message_length_max);
		$writer->writeInt($webfile_dc_id);
		if(is_null($suggested_lang_code) === false):
			$writer->tgwriteBytes($suggested_lang_code);
		endif;
		if(is_null($lang_pack_version) === false):
			$writer->writeInt($lang_pack_version);
		endif;
		if(is_null($base_lang_pack_version) === false):
			$writer->writeInt($base_lang_pack_version);
		endif;
		if(is_null($reactions_default) === false):
			$writer->write($reactions_default->read());
		endif;
		if(is_null($autologin_token) === false):
			$writer->tgwriteBytes($autologin_token);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 3)):
			$result['default_p2p_contacts'] = true;
		else:
			$result['default_p2p_contacts'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['preload_featured_stickers'] = true;
		else:
			$result['preload_featured_stickers'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['revoke_pm_inbox'] = true;
		else:
			$result['revoke_pm_inbox'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['blocked_mode'] = true;
		else:
			$result['blocked_mode'] = false;
		endif;
		if($flags & (1 << 14)):
			$result['force_try_ipv6'] = true;
		else:
			$result['force_try_ipv6'] = false;
		endif;
		$result['date'] = $reader->readInt();
		$result['expires'] = $reader->readInt();
		$result['test_mode'] = $reader->tgreadBool();
		$result['this_dc'] = $reader->readInt();
		$result['dc_options'] = $reader->tgreadVector('DcOption');
		$result['dc_txt_domain_name'] = $reader->tgreadBytes();
		$result['chat_size_max'] = $reader->readInt();
		$result['megagroup_size_max'] = $reader->readInt();
		$result['forwarded_count_max'] = $reader->readInt();
		$result['online_update_period_ms'] = $reader->readInt();
		$result['offline_blur_timeout_ms'] = $reader->readInt();
		$result['offline_idle_timeout_ms'] = $reader->readInt();
		$result['online_cloud_timeout_ms'] = $reader->readInt();
		$result['notify_cloud_delay_ms'] = $reader->readInt();
		$result['notify_default_delay_ms'] = $reader->readInt();
		$result['push_chat_period_ms'] = $reader->readInt();
		$result['push_chat_limit'] = $reader->readInt();
		$result['edit_time_limit'] = $reader->readInt();
		$result['revoke_time_limit'] = $reader->readInt();
		$result['revoke_pm_time_limit'] = $reader->readInt();
		$result['rating_e_decay'] = $reader->readInt();
		$result['stickers_recent_limit'] = $reader->readInt();
		$result['channels_read_media_period'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['tmp_sessions'] = $reader->readInt();
		else:
			$result['tmp_sessions'] = null;
		endif;
		$result['call_receive_timeout_ms'] = $reader->readInt();
		$result['call_ring_timeout_ms'] = $reader->readInt();
		$result['call_connect_timeout_ms'] = $reader->readInt();
		$result['call_packet_timeout_ms'] = $reader->readInt();
		$result['me_url_prefix'] = $reader->tgreadBytes();
		if($flags & (1 << 7)):
			$result['autoupdate_url_prefix'] = $reader->tgreadBytes();
		else:
			$result['autoupdate_url_prefix'] = null;
		endif;
		if($flags & (1 << 9)):
			$result['gif_search_username'] = $reader->tgreadBytes();
		else:
			$result['gif_search_username'] = null;
		endif;
		if($flags & (1 << 10)):
			$result['venue_search_username'] = $reader->tgreadBytes();
		else:
			$result['venue_search_username'] = null;
		endif;
		if($flags & (1 << 11)):
			$result['img_search_username'] = $reader->tgreadBytes();
		else:
			$result['img_search_username'] = null;
		endif;
		if($flags & (1 << 12)):
			$result['static_maps_provider'] = $reader->tgreadBytes();
		else:
			$result['static_maps_provider'] = null;
		endif;
		$result['caption_length_max'] = $reader->readInt();
		$result['message_length_max'] = $reader->readInt();
		$result['webfile_dc_id'] = $reader->readInt();
		if($flags & (1 << 2)):
			$result['suggested_lang_code'] = $reader->tgreadBytes();
		else:
			$result['suggested_lang_code'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['lang_pack_version'] = $reader->readInt();
		else:
			$result['lang_pack_version'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['base_lang_pack_version'] = $reader->readInt();
		else:
			$result['base_lang_pack_version'] = null;
		endif;
		if($flags & (1 << 15)):
			$result['reactions_default'] = $reader->tgreadObject();
		else:
			$result['reactions_default'] = null;
		endif;
		if($flags & (1 << 16)):
			$result['autologin_token'] = $reader->tgreadBytes();
		else:
			$result['autologin_token'] = null;
		endif;
		return new self($result);
	}
}

?>