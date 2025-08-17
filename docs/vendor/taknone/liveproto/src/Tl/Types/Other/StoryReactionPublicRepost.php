<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer_id storyitem story
 * @return StoryReaction
 */

final class StoryReactionPublicRepost extends Instance {
	public function request(object $peer_id,object $story) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcfcd0f13);
		$writer->write($peer_id->read());
		$writer->write($story->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer_id'] = $reader->tgreadObject();
		$result['story'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>