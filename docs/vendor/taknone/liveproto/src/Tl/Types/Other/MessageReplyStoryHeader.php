<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int story_id
 * @return MessageReplyHeader
 */

final class MessageReplyStoryHeader extends Instance {
	public function request(object $peer,int $story_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe5af939);
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