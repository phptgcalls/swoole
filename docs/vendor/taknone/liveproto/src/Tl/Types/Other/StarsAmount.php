<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long amount int nanos
 * @return StarsAmount
 */

final class StarsAmount extends Instance {
	public function request(int $amount,int $nanos) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbbb6b4a3);
		$writer->writeLong($amount);
		$writer->writeInt($nanos);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['amount'] = $reader->readLong();
		$result['nanos'] = $reader->readInt();
		return new self($result);
	}
}

?>