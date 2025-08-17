<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string type int w int h int size
 * @return PhotoSize
 */

final class PhotoSize extends Instance {
	public function request(string $type,int $w,int $h,int $size) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x75c78e60);
		$writer->tgwriteBytes($type);
		$writer->writeInt($w);
		$writer->writeInt($h);
		$writer->writeInt($size);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadBytes();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		$result['size'] = $reader->readInt();
		return new self($result);
	}
}

?>