<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id long client_id
 * @return ImportedContact
 */

final class ImportedContact extends Instance {
	public function request(int $user_id,int $client_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc13e3c50);
		$writer->writeLong($user_id);
		$writer->writeLong($client_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['client_id'] = $reader->readLong();
		return new self($result);
	}
}

?>