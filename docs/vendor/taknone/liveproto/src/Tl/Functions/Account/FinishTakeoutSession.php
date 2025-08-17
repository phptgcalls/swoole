<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true success
 * @return Bool
 */

final class FinishTakeoutSession extends Instance {
	public function request(? true $success = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1d2652ee);
		$flags = 0;
		$flags |= is_null($success) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>