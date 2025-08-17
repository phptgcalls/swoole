<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string email
 * @return SecurePlainData
 */

final class SecurePlainEmail extends Instance {
	public function request(string $email) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x21ec5a5f);
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