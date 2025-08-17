<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int pts int pts_count int offset
 * @return messages.AffectedHistory
 */

final class AffectedHistory extends Instance {
	public function request(int $pts,int $pts_count,int $offset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb45c69d1);
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		$writer->writeInt($offset);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		$result['offset'] = $reader->readInt();
		return new self($result);
	}
}

?>