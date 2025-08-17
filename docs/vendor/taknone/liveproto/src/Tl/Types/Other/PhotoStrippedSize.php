<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string type bytes bytes
 * @return PhotoSize
 */

final class PhotoStrippedSize extends Instance {
	public function request(string $type,string $bytes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe0b0bc2e);
		$writer->tgwriteBytes($type);
		$writer->tgwriteBytes($bytes);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadBytes();
		$result['bytes'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>