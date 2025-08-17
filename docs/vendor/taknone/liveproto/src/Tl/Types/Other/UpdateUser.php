<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id
 * @return Update
 */

final class UpdateUser extends Instance {
	public function request(int $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x20529438);
		$writer->writeLong($user_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		return new self($result);
	}
}

?>