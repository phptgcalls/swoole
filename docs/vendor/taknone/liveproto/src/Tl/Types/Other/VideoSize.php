<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string type int w int h int size double video_start_ts
 * @return VideoSize
 */

final class VideoSize extends Instance {
	public function request(string $type,int $w,int $h,int $size,? float $video_start_ts = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xde33b094);
		$flags = 0;
		$flags |= is_null($video_start_ts) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($type);
		$writer->writeInt($w);
		$writer->writeInt($h);
		$writer->writeInt($size);
		if(is_null($video_start_ts) === false):
			$writer->writeDouble($video_start_ts);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['type'] = $reader->tgreadBytes();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		$result['size'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['video_start_ts'] = $reader->readDouble();
		else:
			$result['video_start_ts'] = null;
		endif;
		return new self($result);
	}
}

?>