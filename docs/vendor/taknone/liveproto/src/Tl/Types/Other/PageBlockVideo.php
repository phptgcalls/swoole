<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long video_id pagecaption caption true autoplay true loop
 * @return PageBlock
 */

final class PageBlockVideo extends Instance {
	public function request(int $video_id,object $caption,? true $autoplay = null,? true $loop = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7c8fe7b6);
		$flags = 0;
		$flags |= is_null($autoplay) ? 0 : (1 << 0);
		$flags |= is_null($loop) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($video_id);
		$writer->write($caption->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['autoplay'] = true;
		else:
			$result['autoplay'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['loop'] = true;
		else:
			$result['loop'] = false;
		endif;
		$result['video_id'] = $reader->readLong();
		$result['caption'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>