<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int offset_id int limit
 * @return stories.Stories
 */

final class GetStoriesArchive extends Instance {
	public function request(object $peer,int $offset_id,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb4352016);
		$writer->write($peer->read());
		$writer->writeInt($offset_id);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>