<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Updates;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int pts
 * @return updates.Difference
 */

final class DifferenceTooLong extends Instance {
	public function request(int $pts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4afe8f6d);
		$writer->writeInt($pts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['pts'] = $reader->readInt();
		return new self($result);
	}
}

?>