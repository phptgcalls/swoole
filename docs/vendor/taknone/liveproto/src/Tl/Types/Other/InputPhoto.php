<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash bytes file_reference
 * @return InputPhoto
 */

final class InputPhoto extends Instance {
	public function request(int $id,int $access_hash,string $file_reference) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3bb3b94a);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->tgwriteBytes($file_reference);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['file_reference'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>