<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Photos;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true fallback inputuser bot inputfile file inputfile video double video_start_ts videosize video_emoji_markup
 * @return photos.Photo
 */

final class UploadProfilePhoto extends Instance {
	public function request(? true $fallback = null,? object $bot = null,? object $file = null,? object $video = null,? float $video_start_ts = null,? object $video_emoji_markup = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x388a3b5);
		$flags = 0;
		$flags |= is_null($fallback) ? 0 : (1 << 3);
		$flags |= is_null($bot) ? 0 : (1 << 5);
		$flags |= is_null($file) ? 0 : (1 << 0);
		$flags |= is_null($video) ? 0 : (1 << 1);
		$flags |= is_null($video_start_ts) ? 0 : (1 << 2);
		$flags |= is_null($video_emoji_markup) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		if(is_null($bot) === false):
			$writer->write($bot->read());
		endif;
		if(is_null($file) === false):
			$writer->write($file->read());
		endif;
		if(is_null($video) === false):
			$writer->write($video->read());
		endif;
		if(is_null($video_start_ts) === false):
			$writer->writeDouble($video_start_ts);
		endif;
		if(is_null($video_emoji_markup) === false):
			$writer->write($video_emoji_markup->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>