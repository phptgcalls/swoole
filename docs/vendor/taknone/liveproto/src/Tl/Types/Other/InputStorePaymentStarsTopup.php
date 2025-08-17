<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long stars string currency long amount
 * @return InputStorePaymentPurpose
 */

final class InputStorePaymentStarsTopup extends Instance {
	public function request(int $stars,string $currency,int $amount) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdddd0f56);
		$writer->writeLong($stars);
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['stars'] = $reader->readLong();
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		return new self($result);
	}
}

?>