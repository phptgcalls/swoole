<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long amount
 * @return StarsAmount
 */

final class StarsTonAmount extends Instance {
	public function request(int $amount) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x74aee3e0);
		$writer->writeLong($amount);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['amount'] = $reader->readLong();
		return new self($result);
	}
}

?>