<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int pos long user_id int score
 * @return HighScore
 */

final class HighScore extends Instance {
	public function request(int $pos,int $user_id,int $score) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x73a379eb);
		$writer->writeInt($pos);
		$writer->writeLong($user_id);
		$writer->writeInt($score);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['pos'] = $reader->readInt();
		$result['user_id'] = $reader->readLong();
		$result['score'] = $reader->readInt();
		return new self($result);
	}
}

?>