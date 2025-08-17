<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int story_id peer peer reaction reaction
 * @return Update
 */

final class UpdateNewStoryReaction extends Instance {
	public function request(int $story_id,object $peer,object $reaction) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1824e40b);
		$writer->writeInt($story_id);
		$writer->write($peer->read());
		$writer->write($reaction->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['story_id'] = $reader->readInt();
		$result['peer'] = $reader->tgreadObject();
		$result['reaction'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>