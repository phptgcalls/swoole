<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return DestroyAuthKeyRes
 */

final class DestroyAuthKeyFail extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xea109b13);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>