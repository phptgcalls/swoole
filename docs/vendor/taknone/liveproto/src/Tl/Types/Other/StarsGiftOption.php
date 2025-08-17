<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long stars string currency long amount true extended string store_product
 * @return StarsGiftOption
 */

final class StarsGiftOption extends Instance {
	public function request(int $stars,string $currency,int $amount,? true $extended = null,? string $store_product = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5e0589f1);
		$flags = 0;
		$flags |= is_null($extended) ? 0 : (1 << 1);
		$flags |= is_null($store_product) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($stars);
		if(is_null($store_product) === false):
			$writer->tgwriteBytes($store_product);
		endif;
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['extended'] = true;
		else:
			$result['extended'] = false;
		endif;
		$result['stars'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['store_product'] = $reader->tgreadBytes();
		else:
			$result['store_product'] = null;
		endif;
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		return new self($result);
	}
}

?>