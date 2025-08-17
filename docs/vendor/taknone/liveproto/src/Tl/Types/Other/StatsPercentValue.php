<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param double part double total
 * @return StatsPercentValue
 */

final class StatsPercentValue extends Instance {
	public function request(float $part,float $total) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcbce2fe0);
		$writer->writeDouble($part);
		$writer->writeDouble($total);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['part'] = $reader->readDouble();
		$result['total'] = $reader->readDouble();
		return new self($result);
	}
}

?>