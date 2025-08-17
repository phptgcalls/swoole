<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count long stars
 * @return MessageAction
 */

final class MessageActionPaidMessagesRefunded extends Instance {
	public function request(int $count,int $stars) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xac1f1fcd);
		$writer->writeInt($count);
		$writer->writeLong($stars);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['stars'] = $reader->readLong();
		return new self($result);
	}
}

?>