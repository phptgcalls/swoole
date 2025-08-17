<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int users int months string currency long amount string store_product int store_quantity
 * @return PremiumGiftCodeOption
 */

final class PremiumGiftCodeOption extends Instance {
	public function request(int $users,int $months,string $currency,int $amount,? string $store_product = null,? int $store_quantity = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x257e962b);
		$flags = 0;
		$flags |= is_null($store_product) ? 0 : (1 << 0);
		$flags |= is_null($store_quantity) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeInt($users);
		$writer->writeInt($months);
		if(is_null($store_product) === false):
			$writer->tgwriteBytes($store_product);
		endif;
		if(is_null($store_quantity) === false):
			$writer->writeInt($store_quantity);
		endif;
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['users'] = $reader->readInt();
		$result['months'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['store_product'] = $reader->tgreadBytes();
		else:
			$result['store_product'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['store_quantity'] = $reader->readInt();
		else:
			$result['store_quantity'] = null;
		endif;
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		return new self($result);
	}
}

?>