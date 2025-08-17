<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long stars int quantity int boosts int date
 * @return PrepaidGiveaway
 */

final class PrepaidStarsGiveaway extends Instance {
	public function request(int $id,int $stars,int $quantity,int $boosts,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9a9d77e0);
		$writer->writeLong($id);
		$writer->writeLong($stars);
		$writer->writeInt($quantity);
		$writer->writeInt($boosts);
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['stars'] = $reader->readLong();
		$result['quantity'] = $reader->readInt();
		$result['boosts'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>