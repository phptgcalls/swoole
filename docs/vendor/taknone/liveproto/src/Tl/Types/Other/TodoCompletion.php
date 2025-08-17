<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id long completed_by int date
 * @return TodoCompletion
 */

final class TodoCompletion extends Instance {
	public function request(int $id,int $completed_by,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4cc120b7);
		$writer->writeInt($id);
		$writer->writeLong($completed_by);
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readInt();
		$result['completed_by'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>