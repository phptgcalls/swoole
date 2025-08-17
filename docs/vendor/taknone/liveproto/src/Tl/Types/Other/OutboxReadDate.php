<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date
 * @return OutboxReadDate
 */

final class OutboxReadDate extends Instance {
	public function request(int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3bb842ac);
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>