<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date int min_msg_id int max_msg_id int count
 * @return SearchResultsCalendarPeriod
 */

final class SearchResultsCalendarPeriod extends Instance {
	public function request(int $date,int $min_msg_id,int $max_msg_id,int $count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc9b0539f);
		$writer->writeInt($date);
		$writer->writeInt($min_msg_id);
		$writer->writeInt($max_msg_id);
		$writer->writeInt($count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['date'] = $reader->readInt();
		$result['min_msg_id'] = $reader->readInt();
		$result['max_msg_id'] = $reader->readInt();
		$result['count'] = $reader->readInt();
		return new self($result);
	}
}

?>