<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string email_pattern int length
 * @return account.SentEmailCode
 */

final class SentEmailCode extends Instance {
	public function request(string $email_pattern,int $length) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x811f854f);
		$writer->tgwriteBytes($email_pattern);
		$writer->writeInt($length);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['email_pattern'] = $reader->tgreadBytes();
		$result['length'] = $reader->readInt();
		return new self($result);
	}
}

?>