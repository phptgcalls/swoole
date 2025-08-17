<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long stars_amount
 * @return account.PaidMessagesRevenue
 */

final class PaidMessagesRevenue extends Instance {
	public function request(int $stars_amount) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1e109708);
		$writer->writeLong($stars_amount);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['stars_amount'] = $reader->readLong();
		return new self($result);
	}
}

?>