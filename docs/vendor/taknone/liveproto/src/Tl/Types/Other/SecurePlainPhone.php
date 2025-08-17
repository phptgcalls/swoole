<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone
 * @return SecurePlainData
 */

final class SecurePlainPhone extends Instance {
	public function request(string $phone) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7d6099dd);
		$writer->tgwriteBytes($phone);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['phone'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>