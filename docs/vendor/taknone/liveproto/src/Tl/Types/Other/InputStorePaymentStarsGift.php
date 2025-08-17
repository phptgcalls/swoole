<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id long stars string currency long amount
 * @return InputStorePaymentPurpose
 */

final class InputStorePaymentStarsGift extends Instance {
	public function request(object $user_id,int $stars,string $currency,int $amount) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1d741ef7);
		$writer->write($user_id->read());
		$writer->writeLong($stars);
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->tgreadObject();
		$result['stars'] = $reader->readLong();
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		return new self($result);
	}
}

?>