<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param emailverifypurpose purpose string email
 * @return account.SentEmailCode
 */

final class SendVerifyEmailCode extends Instance {
	public function request(object $purpose,string $email) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x98e037bb);
		$writer->write($purpose->read());
		$writer->tgwriteBytes($email);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>