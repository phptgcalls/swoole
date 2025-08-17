<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string type filelocation location int w int h int size
 * @return secret.PhotoSize
 */

final class PhotoSize extends Instance {
	public function request(string $type,object $location,int $w,int $h,int $size) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x77bfb61b);
		$writer->tgwriteBytes($type);
		$writer->write($location->read());
		$writer->writeInt($w);
		$writer->writeInt($h);
		$writer->writeInt($size);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadBytes();
		$result['location'] = $reader->tgreadObject();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		$result['size'] = $reader->readInt();
		return new self($result);
	}
}

?>