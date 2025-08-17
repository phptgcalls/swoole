<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int period
 * @return DefaultHistoryTTL
 */

final class DefaultHistoryTTL extends Instance {
	public function request(int $period) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x43b46b20);
		$writer->writeInt($period);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['period'] = $reader->readInt();
		return new self($result);
	}
}

?>