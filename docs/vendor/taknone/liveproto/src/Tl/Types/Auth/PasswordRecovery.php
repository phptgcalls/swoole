<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string email_pattern
 * @return auth.PasswordRecovery
 */

final class PasswordRecovery extends Instance {
	public function request(string $email_pattern) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x137948a5);
		$writer->tgwriteBytes($email_pattern);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['email_pattern'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>