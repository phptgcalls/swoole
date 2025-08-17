<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int expires
 * @return UserStatus
 */

final class UserStatusOnline extends Instance {
	public function request(int $expires) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xedb93949);
		$writer->writeInt($expires);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['expires'] = $reader->readInt();
		return new self($result);
	}
}

?>