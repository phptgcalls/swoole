<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long game_id int score
 * @return MessageAction
 */

final class MessageActionGameScore extends Instance {
	public function request(int $game_id,int $score) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x92a72876);
		$writer->writeLong($game_id);
		$writer->writeInt($score);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['game_id'] = $reader->readLong();
		$result['score'] = $reader->readInt();
		return new self($result);
	}
}

?>