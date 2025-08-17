<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param double duration int w int h true round_message true supports_streaming true nosound int preload_prefix_size double video_start_ts string video_codec
 * @return DocumentAttribute
 */

final class DocumentAttributeVideo extends Instance {
	public function request(float $duration,int $w,int $h,? true $round_message = null,? true $supports_streaming = null,? true $nosound = null,? int $preload_prefix_size = null,? float $video_start_ts = null,? string $video_codec = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x43c57c48);
		$flags = 0;
		$flags |= is_null($round_message) ? 0 : (1 << 0);
		$flags |= is_null($supports_streaming) ? 0 : (1 << 1);
		$flags |= is_null($nosound) ? 0 : (1 << 3);
		$flags |= is_null($preload_prefix_size) ? 0 : (1 << 2);
		$flags |= is_null($video_start_ts) ? 0 : (1 << 4);
		$flags |= is_null($video_codec) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		$writer->writeDouble($duration);
		$writer->writeInt($w);
		$writer->writeInt($h);
		if(is_null($preload_prefix_size) === false):
			$writer->writeInt($preload_prefix_size);
		endif;
		if(is_null($video_start_ts) === false):
			$writer->writeDouble($video_start_ts);
		endif;
		if(is_null($video_codec) === false):
			$writer->tgwriteBytes($video_codec);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['round_message'] = true;
		else:
			$result['round_message'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['supports_streaming'] = true;
		else:
			$result['supports_streaming'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['nosound'] = true;
		else:
			$result['nosound'] = false;
		endif;
		$result['duration'] = $reader->readDouble();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		if($flags & (1 << 2)):
			$result['preload_prefix_size'] = $reader->readInt();
		else:
			$result['preload_prefix_size'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['video_start_ts'] = $reader->readDouble();
		else:
			$result['video_start_ts'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['video_codec'] = $reader->tgreadBytes();
		else:
			$result['video_codec'] = null;
		endif;
		return new self($result);
	}
}

?>