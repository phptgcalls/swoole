<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int period long amount
 * @return StarsSubscriptionPricing
 */

final class StarsSubscriptionPricing extends Instance {
	public function request(int $period,int $amount) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5416d58);
		$writer->writeInt($period);
		$writer->writeLong($amount);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['period'] = $reader->readInt();
		$result['amount'] = $reader->readLong();
		return new self($result);
	}
}

?>