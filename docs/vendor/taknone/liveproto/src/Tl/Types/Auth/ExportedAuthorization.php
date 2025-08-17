<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id bytes bytes
 * @return auth.ExportedAuthorization
 */

final class ExportedAuthorization extends Instance {
	public function request(int $id,string $bytes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb434e2b8);
		$writer->writeLong($id);
		$writer->tgwriteBytes($bytes);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['bytes'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>