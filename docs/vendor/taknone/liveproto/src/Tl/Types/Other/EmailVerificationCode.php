<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string code
 * @return EmailVerification
 */

final class EmailVerificationCode extends Instance {
	public function request(string $code) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x922e55a9);
		$writer->tgwriteBytes($code);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['code'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>