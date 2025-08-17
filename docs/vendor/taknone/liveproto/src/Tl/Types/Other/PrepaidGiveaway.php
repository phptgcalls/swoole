<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id int months int quantity int date
 * @return PrepaidGiveaway
 */

final class PrepaidGiveaway extends Instance {
	public function request(int $id,int $months,int $quantity,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb2539d54);
		$writer->writeLong($id);
		$writer->writeInt($months);
		$writer->writeInt($quantity);
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['months'] = $reader->readInt();
		$result['quantity'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>