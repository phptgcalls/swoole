<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long client_id int importers
 * @return PopularContact
 */

final class PopularContact extends Instance {
	public function request(int $client_id,int $importers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5ce14175);
		$writer->writeLong($client_id);
		$writer->writeInt($importers);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['client_id'] = $reader->readLong();
		$result['importers'] = $reader->readInt();
		return new self($result);
	}
}

?>