<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer_id int date reaction reaction
 * @return StoryReaction
 */

final class StoryReaction extends Instance {
	public function request(object $peer_id,int $date,object $reaction) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6090d6d5);
		$writer->write($peer_id->read());
		$writer->writeInt($date);
		$writer->write($reaction->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer_id'] = $reader->tgreadObject();
		$result['date'] = $reader->readInt();
		$result['reaction'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>