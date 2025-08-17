<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int photo_size_max long video_size_max long file_size_max int video_upload_maxbitrate int small_queue_active_operations_max int large_queue_active_operations_max true disabled true video_preload_large true audio_preload_next true phonecalls_less_data true stories_preload
 * @return AutoDownloadSettings
 */

final class AutoDownloadSettings extends Instance {
	public function request(int $photo_size_max,int $video_size_max,int $file_size_max,int $video_upload_maxbitrate,int $small_queue_active_operations_max,int $large_queue_active_operations_max,? true $disabled = null,? true $video_preload_large = null,? true $audio_preload_next = null,? true $phonecalls_less_data = null,? true $stories_preload = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbaa57628);
		$flags = 0;
		$flags |= is_null($disabled) ? 0 : (1 << 0);
		$flags |= is_null($video_preload_large) ? 0 : (1 << 1);
		$flags |= is_null($audio_preload_next) ? 0 : (1 << 2);
		$flags |= is_null($phonecalls_less_data) ? 0 : (1 << 3);
		$flags |= is_null($stories_preload) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->writeInt($photo_size_max);
		$writer->writeLong($video_size_max);
		$writer->writeLong($file_size_max);
		$writer->writeInt($video_upload_maxbitrate);
		$writer->writeInt($small_queue_active_operations_max);
		$writer->writeInt($large_queue_active_operations_max);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['disabled'] = true;
		else:
			$result['disabled'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['video_preload_large'] = true;
		else:
			$result['video_preload_large'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['audio_preload_next'] = true;
		else:
			$result['audio_preload_next'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['phonecalls_less_data'] = true;
		else:
			$result['phonecalls_less_data'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['stories_preload'] = true;
		else:
			$result['stories_preload'] = false;
		endif;
		$result['photo_size_max'] = $reader->readInt();
		$result['video_size_max'] = $reader->readLong();
		$result['file_size_max'] = $reader->readLong();
		$result['video_upload_maxbitrate'] = $reader->readInt();
		$result['small_queue_active_operations_max'] = $reader->readInt();
		$result['large_queue_active_operations_max'] = $reader->readInt();
		return new self($result);
	}
}

?>