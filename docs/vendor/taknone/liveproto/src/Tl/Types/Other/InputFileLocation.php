<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long volume_id int local_id long secret bytes file_reference
 * @return InputFileLocation
 */

final class InputFileLocation extends Instance {
	public function request(int $volume_id,int $local_id,int $secret,string $file_reference) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdfdaabe1);
		$writer->writeLong($volume_id);
		$writer->writeInt($local_id);
		$writer->writeLong($secret);
		$writer->tgwriteBytes($file_reference);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['volume_id'] = $reader->readLong();
		$result['local_id'] = $reader->readInt();
		$result['secret'] = $reader->readLong();
		$result['file_reference'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>