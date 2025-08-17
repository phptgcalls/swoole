<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone
 * @return InputCollectible
 */

final class InputCollectiblePhone extends Instance {
	public function request(string $phone) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa2e214a4);
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