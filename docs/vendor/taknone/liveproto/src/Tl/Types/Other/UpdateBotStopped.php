<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id int date bool stopped int qts
 * @return Update
 */

final class UpdateBotStopped extends Instance {
	public function request(int $user_id,int $date,bool $stopped,int $qts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc4870a49);
		$writer->writeLong($user_id);
		$writer->writeInt($date);
		$writer->tgwriteBool($stopped);
		$writer->writeInt($qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		$result['stopped'] = $reader->tgreadBool();
		$result['qts'] = $reader->readInt();
		return new self($result);
	}
}

?>