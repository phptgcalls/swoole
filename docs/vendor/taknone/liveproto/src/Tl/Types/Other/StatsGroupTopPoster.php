<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id int messages int avg_chars
 * @return StatsGroupTopPoster
 */

final class StatsGroupTopPoster extends Instance {
	public function request(int $user_id,int $messages,int $avg_chars) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9d04af9b);
		$writer->writeLong($user_id);
		$writer->writeInt($messages);
		$writer->writeInt($avg_chars);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['messages'] = $reader->readInt();
		$result['avg_chars'] = $reader->readInt();
		return new self($result);
	}
}

?>