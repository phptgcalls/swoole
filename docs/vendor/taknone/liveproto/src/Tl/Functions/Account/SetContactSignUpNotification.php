<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bool silent
 * @return Bool
 */

final class SetContactSignUpNotification extends Instance {
	public function request(bool $silent) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcff43f61);
		$writer->tgwriteBool($silent);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>