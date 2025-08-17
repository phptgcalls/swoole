<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id userstatus status
 * @return Update
 */

final class UpdateUserStatus extends Instance {
	public function request(int $user_id,object $status) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe5bdf8de);
		$writer->writeLong($user_id);
		$writer->write($status->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['status'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>