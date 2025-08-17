<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash int duration
 * @return GroupCall
 */

final class GroupCallDiscarded extends Instance {
	public function request(int $id,int $access_hash,int $duration) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7780bcb4);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->writeInt($duration);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['duration'] = $reader->readInt();
		return new self($result);
	}
}

?>