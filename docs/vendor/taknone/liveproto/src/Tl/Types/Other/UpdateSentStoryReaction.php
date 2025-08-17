<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int story_id reaction reaction
 * @return Update
 */

final class UpdateSentStoryReaction extends Instance {
	public function request(object $peer,int $story_id,object $reaction) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7d627683);
		$writer->write($peer->read());
		$writer->writeInt($story_id);
		$writer->write($reaction->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['story_id'] = $reader->readInt();
		$result['reaction'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>