<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash int participants_count int unmuted_video_limit int version true join_muted true can_change_join_muted true join_date_asc true schedule_start_subscribed true can_start_video true record_video_active true rtmp_stream true listeners_hidden true conference true creator string title int stream_dc_id int record_start_date int schedule_date int unmuted_video_count string invite_link
 * @return GroupCall
 */

final class GroupCall extends Instance {
	public function request(int $id,int $access_hash,int $participants_count,int $unmuted_video_limit,int $version,? true $join_muted = null,? true $can_change_join_muted = null,? true $join_date_asc = null,? true $schedule_start_subscribed = null,? true $can_start_video = null,? true $record_video_active = null,? true $rtmp_stream = null,? true $listeners_hidden = null,? true $conference = null,? true $creator = null,? string $title = null,? int $stream_dc_id = null,? int $record_start_date = null,? int $schedule_date = null,? int $unmuted_video_count = null,? string $invite_link = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x553b0ba1);
		$flags = 0;
		$flags |= is_null($join_muted) ? 0 : (1 << 1);
		$flags |= is_null($can_change_join_muted) ? 0 : (1 << 2);
		$flags |= is_null($join_date_asc) ? 0 : (1 << 6);
		$flags |= is_null($schedule_start_subscribed) ? 0 : (1 << 8);
		$flags |= is_null($can_start_video) ? 0 : (1 << 9);
		$flags |= is_null($record_video_active) ? 0 : (1 << 11);
		$flags |= is_null($rtmp_stream) ? 0 : (1 << 12);
		$flags |= is_null($listeners_hidden) ? 0 : (1 << 13);
		$flags |= is_null($conference) ? 0 : (1 << 14);
		$flags |= is_null($creator) ? 0 : (1 << 15);
		$flags |= is_null($title) ? 0 : (1 << 3);
		$flags |= is_null($stream_dc_id) ? 0 : (1 << 4);
		$flags |= is_null($record_start_date) ? 0 : (1 << 5);
		$flags |= is_null($schedule_date) ? 0 : (1 << 7);
		$flags |= is_null($unmuted_video_count) ? 0 : (1 << 10);
		$flags |= is_null($invite_link) ? 0 : (1 << 16);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->writeInt($participants_count);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($stream_dc_id) === false):
			$writer->writeInt($stream_dc_id);
		endif;
		if(is_null($record_start_date) === false):
			$writer->writeInt($record_start_date);
		endif;
		if(is_null($schedule_date) === false):
			$writer->writeInt($schedule_date);
		endif;
		if(is_null($unmuted_video_count) === false):
			$writer->writeInt($unmuted_video_count);
		endif;
		$writer->writeInt($unmuted_video_limit);
		$writer->writeInt($version);
		if(is_null($invite_link) === false):
			$writer->tgwriteBytes($invite_link);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['join_muted'] = true;
		else:
			$result['join_muted'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['can_change_join_muted'] = true;
		else:
			$result['can_change_join_muted'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['join_date_asc'] = true;
		else:
			$result['join_date_asc'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['schedule_start_subscribed'] = true;
		else:
			$result['schedule_start_subscribed'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['can_start_video'] = true;
		else:
			$result['can_start_video'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['record_video_active'] = true;
		else:
			$result['record_video_active'] = false;
		endif;
		if($flags & (1 << 12)):
			$result['rtmp_stream'] = true;
		else:
			$result['rtmp_stream'] = false;
		endif;
		if($flags & (1 << 13)):
			$result['listeners_hidden'] = true;
		else:
			$result['listeners_hidden'] = false;
		endif;
		if($flags & (1 << 14)):
			$result['conference'] = true;
		else:
			$result['conference'] = false;
		endif;
		if($flags & (1 << 15)):
			$result['creator'] = true;
		else:
			$result['creator'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['participants_count'] = $reader->readInt();
		if($flags & (1 << 3)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['stream_dc_id'] = $reader->readInt();
		else:
			$result['stream_dc_id'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['record_start_date'] = $reader->readInt();
		else:
			$result['record_start_date'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['schedule_date'] = $reader->readInt();
		else:
			$result['schedule_date'] = null;
		endif;
		if($flags & (1 << 10)):
			$result['unmuted_video_count'] = $reader->readInt();
		else:
			$result['unmuted_video_count'] = null;
		endif;
		$result['unmuted_video_limit'] = $reader->readInt();
		$result['version'] = $reader->readInt();
		if($flags & (1 << 16)):
			$result['invite_link'] = $reader->tgreadBytes();
		else:
			$result['invite_link'] = null;
		endif;
		return new self($result);
	}
}

?>