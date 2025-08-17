<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true by_me
 * @return UserStatus
 */

final class UserStatusLastWeek extends Instance {
	public function request(? true $by_me = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x541a1d1a);
		$flags = 0;
		$flags |= is_null($by_me) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['by_me'] = true;
		else:
			$result['by_me'] = false;
		endif;
		return new self($result);
	}
}

?>