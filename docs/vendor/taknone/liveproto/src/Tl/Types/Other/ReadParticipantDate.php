<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id int date
 * @return ReadParticipantDate
 */

final class ReadParticipantDate extends Instance {
	public function request(int $user_id,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4a4ff172);
		$writer->writeLong($user_id);
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>