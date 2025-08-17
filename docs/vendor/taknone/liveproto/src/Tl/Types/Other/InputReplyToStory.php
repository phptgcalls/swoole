<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int story_id
 * @return InputReplyTo
 */

final class InputReplyToStory extends Instance {
	public function request(object $peer,int $story_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5881323a);
		$writer->write($peer->read());
		$writer->writeInt($story_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['story_id'] = $reader->readInt();
		return new self($result);
	}
}

?>