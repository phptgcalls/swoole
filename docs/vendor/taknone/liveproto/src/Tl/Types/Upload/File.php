<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Upload;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param storage type int mtime bytes bytes
 * @return upload.File
 */

final class File extends Instance {
	public function request(object $type,int $mtime,string $bytes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x96a18d5);
		$writer->write($type->read());
		$writer->writeInt($mtime);
		$writer->tgwriteBytes($bytes);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadObject();
		$result['mtime'] = $reader->readInt();
		$result['bytes'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>