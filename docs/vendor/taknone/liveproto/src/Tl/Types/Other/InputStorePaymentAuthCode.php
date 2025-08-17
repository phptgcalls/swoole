<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string phone_code_hash string currency long amount true restore
 * @return InputStorePaymentPurpose
 */

final class InputStorePaymentAuthCode extends Instance {
	public function request(string $phone_number,string $phone_code_hash,string $currency,int $amount,? true $restore = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9bb2636d);
		$flags = 0;
		$flags |= is_null($restore) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($phone_code_hash);
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['restore'] = true;
		else:
			$result['restore'] = false;
		endif;
		$result['phone_number'] = $reader->tgreadBytes();
		$result['phone_code_hash'] = $reader->tgreadBytes();
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		return new self($result);
	}
}

?>