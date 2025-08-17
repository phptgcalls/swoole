<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int months string currency long amount string bot_url true current true can_purchase_upgrade string transaction string store_product
 * @return PremiumSubscriptionOption
 */

final class PremiumSubscriptionOption extends Instance {
	public function request(int $months,string $currency,int $amount,string $bot_url,? true $current = null,? true $can_purchase_upgrade = null,? string $transaction = null,? string $store_product = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5f2d1df2);
		$flags = 0;
		$flags |= is_null($current) ? 0 : (1 << 1);
		$flags |= is_null($can_purchase_upgrade) ? 0 : (1 << 2);
		$flags |= is_null($transaction) ? 0 : (1 << 3);
		$flags |= is_null($store_product) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($transaction) === false):
			$writer->tgwriteBytes($transaction);
		endif;
		$writer->writeInt($months);
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		$writer->tgwriteBytes($bot_url);
		if(is_null($store_product) === false):
			$writer->tgwriteBytes($store_product);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['current'] = true;
		else:
			$result['current'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['can_purchase_upgrade'] = true;
		else:
			$result['can_purchase_upgrade'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['transaction'] = $reader->tgreadBytes();
		else:
			$result['transaction'] = null;
		endif;
		$result['months'] = $reader->readInt();
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		$result['bot_url'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['store_product'] = $reader->tgreadBytes();
		else:
			$result['store_product'] = null;
		endif;
		return new self($result);
	}
}

?>