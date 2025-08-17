<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string type int w int h bytes bytes
 * @return PhotoSize
 */

final class PhotoCachedSize extends Instance {
	public function request(string $type,int $w,int $h,string $bytes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x21e1ad6);
		$writer->tgwriteBytes($type);
		$writer->writeInt($w);
		$writer->writeInt($h);
		$writer->tgwriteBytes($bytes);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadBytes();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		$result['bytes'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>