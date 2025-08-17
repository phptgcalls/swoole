<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes salt
 * @return SecurePasswordKdfAlgo
 */

final class SecurePasswordKdfAlgoPBKDF2HMACSHA512iter100000 extends Instance {
	public function request(string $salt) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbbf2dda0);
		$writer->tgwriteBytes($salt);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['salt'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>