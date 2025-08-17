<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param emailverifypurpose purpose emailverification verification
 * @return account.EmailVerified
 */

final class VerifyEmail extends Instance {
	public function request(object $purpose,object $verification) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x32da4cf);
		$writer->write($purpose->read());
		$writer->write($verification->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>