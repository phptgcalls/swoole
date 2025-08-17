<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputcheckpasswordsrp password
 * @return auth.Authorization
 */

final class CheckPassword extends Instance {
	public function request(object $password) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd18b4d16);
		$writer->write($password->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>