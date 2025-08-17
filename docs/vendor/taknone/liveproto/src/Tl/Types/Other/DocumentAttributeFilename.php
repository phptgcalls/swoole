<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string file_name
 * @return DocumentAttribute
 */

final class DocumentAttributeFilename extends Instance {
	public function request(string $file_name) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x15590068);
		$writer->tgwriteBytes($file_name);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['file_name'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>