<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id
 * @return StoryItem
 */

final class StoryItemDeleted extends Instance {
	public function request(int $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x51e6ee4f);
		$writer->writeInt($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readInt();
		return new self($result);
	}
}

?>