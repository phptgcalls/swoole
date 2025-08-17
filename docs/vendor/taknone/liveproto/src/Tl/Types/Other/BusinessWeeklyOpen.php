<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int start_minute int end_minute
 * @return BusinessWeeklyOpen
 */

final class BusinessWeeklyOpen extends Instance {
	public function request(int $start_minute,int $end_minute) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x120b1ab9);
		$writer->writeInt($start_minute);
		$writer->writeInt($end_minute);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['start_minute'] = $reader->readInt();
		$result['end_minute'] = $reader->readInt();
		return new self($result);
	}
}

?>