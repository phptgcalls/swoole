<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> except_auth_keys
 * @return Bool
 */

final class DropTempAuthKeys extends Instance {
	public function request(array $except_auth_keys) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8e48a188);
		$writer->tgwriteVector($except_auth_keys,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>