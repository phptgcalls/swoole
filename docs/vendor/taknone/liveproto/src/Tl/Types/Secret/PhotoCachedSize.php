<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string type filelocation location int w int h bytes bytes
 * @return secret.PhotoSize
 */

final class PhotoCachedSize extends Instance {
	public function request(string $type,object $location,int $w,int $h,string $bytes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe9a734fa);
		$writer->tgwriteBytes($type);
		$writer->write($location->read());
		$writer->writeInt($w);
		$writer->writeInt($h);
		$writer->tgwriteBytes($bytes);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadBytes();
		$result['location'] = $reader->tgreadObject();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		$result['bytes'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>