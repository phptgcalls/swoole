<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string email
 * @return account.EmailVerified
 */

final class EmailVerified extends Instance {
	public function request(string $email) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2b96cd1b);
		$writer->tgwriteBytes($email);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['email'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>