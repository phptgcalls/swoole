<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Upload;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int size string mime_type storage file_type int mtime bytes bytes
 * @return upload.WebFile
 */

final class WebFile extends Instance {
	public function request(int $size,string $mime_type,object $file_type,int $mtime,string $bytes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x21e753bc);
		$writer->writeInt($size);
		$writer->tgwriteBytes($mime_type);
		$writer->write($file_type->read());
		$writer->writeInt($mtime);
		$writer->tgwriteBytes($bytes);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['size'] = $reader->readInt();
		$result['mime_type'] = $reader->tgreadBytes();
		$result['file_type'] = $reader->tgreadObject();
		$result['mtime'] = $reader->readInt();
		$result['bytes'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>