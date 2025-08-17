<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id long random_id
 * @return Update
 */

final class UpdateStoryID extends Instance {
	public function request(int $id,int $random_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1bf335b9);
		$writer->writeInt($id);
		$writer->writeLong($random_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readInt();
		$result['random_id'] = $reader->readLong();
		return new self($result);
	}
}

?>