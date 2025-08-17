<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true revoke
 * @return messages.AffectedFoundMessages
 */

final class DeletePhoneCallHistory extends Instance {
	public function request(? true $revoke = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf9cbe409);
		$flags = 0;
		$flags |= is_null($revoke) ? 0 : (1 << 0);
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