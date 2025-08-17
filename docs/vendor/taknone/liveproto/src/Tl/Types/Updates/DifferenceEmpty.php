<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Updates;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date int seq
 * @return updates.Difference
 */

final class DifferenceEmpty extends Instance {
	public function request(int $date,int $seq) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5d75a138);
		$writer->writeInt($date);
		$writer->writeInt($seq);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['date'] = $reader->readInt();
		$result['seq'] = $reader->readInt();
		return new self($result);
	}
}

?>