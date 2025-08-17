<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Fragment;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int purchase_date string currency long amount string crypto_currency long crypto_amount string url
 * @return fragment.CollectibleInfo
 */

final class CollectibleInfo extends Instance {
	public function request(int $purchase_date,string $currency,int $amount,string $crypto_currency,int $crypto_amount,string $url) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6ebdff91);
		$writer->writeInt($purchase_date);
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		$writer->tgwriteBytes($crypto_currency);
		$writer->writeLong($crypto_amount);
		$writer->tgwriteBytes($url);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['purchase_date'] = $reader->readInt();
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		$result['crypto_currency'] = $reader->tgreadBytes();
		$result['crypto_amount'] = $reader->readLong();
		$result['url'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>