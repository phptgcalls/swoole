<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash
 * @return InputFileLocation
 */

final class InputEncryptedFileLocation extends Instance {
	public function request(int $id,int $access_hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf5235d55);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		return new self($result);
	}
}

?>