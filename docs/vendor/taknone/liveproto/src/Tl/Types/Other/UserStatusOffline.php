<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int was_online
 * @return UserStatus
 */

final class UserStatusOffline extends Instance {
	public function request(int $was_online) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8c703f);
		$writer->writeInt($was_online);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['was_online'] = $reader->readInt();
		return new self($result);
	}
}

?>