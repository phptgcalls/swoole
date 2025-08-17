<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string username
 * @return User
 */

final class UpdateUsername extends Instance {
	public function request(string $username) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3e0bdd7c);
		$writer->tgwriteBytes($username);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>