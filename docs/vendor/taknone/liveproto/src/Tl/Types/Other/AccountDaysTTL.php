<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int days
 * @return AccountDaysTTL
 */

final class AccountDaysTTL extends Instance {
	public function request(int $days) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb8d0afdf);
		$writer->writeInt($days);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['days'] = $reader->readInt();
		return new self($result);
	}
}

?>