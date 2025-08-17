<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param double current double previous
 * @return StatsAbsValueAndPrev
 */

final class StatsAbsValueAndPrev extends Instance {
	public function request(float $current,float $previous) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcb43acde);
		$writer->writeDouble($current);
		$writer->writeDouble($previous);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['current'] = $reader->readDouble();
		$result['previous'] = $reader->readDouble();
		return new self($result);
	}
}

?>