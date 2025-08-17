<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id string currency long amount
 * @return InputStorePaymentPurpose
 */

final class InputStorePaymentGiftPremium extends Instance {
	public function request(object $user_id,string $currency,int $amount) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x616f7fe8);
		$writer->write($user_id->read());
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->tgreadObject();
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		return new self($result);
	}
}

?>