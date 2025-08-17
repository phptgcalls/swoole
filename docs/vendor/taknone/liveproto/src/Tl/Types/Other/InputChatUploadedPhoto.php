<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputfile file inputfile video double video_start_ts videosize video_emoji_markup
 * @return InputChatPhoto
 */

final class InputChatUploadedPhoto extends Instance {
	public function request(? object $file = null,? object $video = null,? float $video_start_ts = null,? object $video_emoji_markup = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbdcdaec0);
		$flags = 0;
		$flags |= is_null($file) ? 0 : (1 << 0);
		$flags |= is_null($video) ? 0 : (1 << 1);
		$flags |= is_null($video_start_ts) ? 0 : (1 << 2);
		$flags |= is_null($video_emoji_markup) ? 0 : (1 << 3);
		$writer->writeInt($flags);
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
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['file'] = $reader->tgreadObject();
		else:
			$result['file'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['video'] = $reader->tgreadObject();
		else:
			$result['video'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['video_start_ts'] = $reader->readDouble();
		else:
			$result['video_start_ts'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['video_emoji_markup'] = $reader->tgreadObject();
		else:
			$result['video_emoji_markup'] = null;
		endif;
		return new self($result);
	}
}

?>