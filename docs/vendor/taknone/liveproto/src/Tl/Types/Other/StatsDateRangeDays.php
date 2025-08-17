<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int min_date int max_date
 * @return StatsDateRangeDays
 */

final class StatsDateRangeDays extends Instance {
	public function request(int $min_date,int $max_date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb637edaf);
		$writer->writeInt($min_date);
		$writer->writeInt($max_date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['min_date'] = $reader->readInt();
		$result['max_date'] = $reader->readInt();
		return new self($result);
	}
}

?>