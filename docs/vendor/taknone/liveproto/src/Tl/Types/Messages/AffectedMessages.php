<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int pts int pts_count
 * @return messages.AffectedMessages
 */

final class AffectedMessages extends Instance {
	public function request(int $pts,int $pts_count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x84d19185);
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		return new self($result);
	}
}

?>