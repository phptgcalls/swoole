<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int start_date int end_date
 * @return BusinessAwayMessageSchedule
 */

final class BusinessAwayMessageScheduleCustom extends Instance {
	public function request(int $start_date,int $end_date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcc4d9ecc);
		$writer->writeInt($start_date);
		$writer->writeInt($end_date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['start_date'] = $reader->readInt();
		$result['end_date'] = $reader->readInt();
		return new self($result);
	}
}

?>