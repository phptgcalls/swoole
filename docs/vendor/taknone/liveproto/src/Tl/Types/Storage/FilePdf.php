<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Storage;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return storage.FileType
 */

final class FilePdf extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xae1e508d);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>