<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count_remains
 * @return stories.CanSendStoryCount
 */

final class CanSendStoryCount extends Instance {
	public function request(int $count_remains) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc387c04e);
		$writer->writeInt($count_remains);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count_remains'] = $reader->readInt();
		return new self($result);
	}
}

?>