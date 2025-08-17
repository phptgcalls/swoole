<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int story_id int views int forwards int reactions
 * @return PostInteractionCounters
 */

final class PostInteractionCountersStory extends Instance {
	public function request(int $story_id,int $views,int $forwards,int $reactions) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8a480e27);
		$writer->writeInt($story_id);
		$writer->writeInt($views);
		$writer->writeInt($forwards);
		$writer->writeInt($reactions);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['story_id'] = $reader->readInt();
		$result['views'] = $reader->readInt();
		$result['forwards'] = $reader->readInt();
		$result['reactions'] = $reader->readInt();
		return new self($result);
	}
}

?>