<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer storyitem story
 * @return FoundStory
 */

final class FoundStory extends Instance {
	public function request(object $peer,object $story) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe87acbc0);
		$writer->write($peer->read());
		$writer->write($story->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['story'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>