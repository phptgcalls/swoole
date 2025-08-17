<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Upload;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes bytes
 * @return upload.CdnFile
 */

final class CdnFile extends Instance {
	public function request(string $bytes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa99fca4f);
		$writer->tgwriteBytes($bytes);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['bytes'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>