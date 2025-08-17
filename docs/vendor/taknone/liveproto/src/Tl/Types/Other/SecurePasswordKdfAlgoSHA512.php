<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes salt
 * @return SecurePasswordKdfAlgo
 */

final class SecurePasswordKdfAlgoSHA512 extends Instance {
	public function request(string $salt) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x86471d92);
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