<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long stars int yearly_boosts string currency long amount Vector<StarsGiveawayWinnersOption> winners true extended true default string store_product
 * @return StarsGiveawayOption
 */

final class StarsGiveawayOption extends Instance {
	public function request(int $stars,int $yearly_boosts,string $currency,int $amount,array $winners,? true $extended = null,? true $default = null,? string $store_product = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x94ce852a);
		$flags = 0;
		$flags |= is_null($extended) ? 0 : (1 << 0);
		$flags |= is_null($default) ? 0 : (1 << 1);
		$flags |= is_null($store_product) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeLong($stars);
		$writer->writeInt($yearly_boosts);
		if(is_null($store_product) === false):
			$writer->tgwriteBytes($store_product);
		endif;
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		$writer->tgwriteVector($winners,'StarsGiveawayWinnersOption');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['extended'] = true;
		else:
			$result['extended'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['default'] = true;
		else:
			$result['default'] = false;
		endif;
		$result['stars'] = $reader->readLong();
		$result['yearly_boosts'] = $reader->readInt();
		if($flags & (1 << 2)):
			$result['store_product'] = $reader->tgreadBytes();
		else:
			$result['store_product'] = null;
		endif;
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		$result['winners'] = $reader->tgreadVector('StarsGiveawayWinnersOption');
		return new self($result);
	}
}

?>