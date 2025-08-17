<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string email auth sent_code
 * @return account.EmailVerified
 */

final class EmailVerifiedLogin extends Instance {
	public function request(string $email,object $sent_code) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe1bb0d61);
		$writer->tgwriteBytes($email);
		$writer->write($sent_code->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['email'] = $reader->tgreadBytes();
		$result['sent_code'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>