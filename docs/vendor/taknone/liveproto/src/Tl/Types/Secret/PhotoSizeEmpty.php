<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string type
 * @return secret.PhotoSize
 */

final class PhotoSizeEmpty extends Instance {
	public function request(string $type) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe17e23c);
		$writer->tgwriteBytes($type);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>