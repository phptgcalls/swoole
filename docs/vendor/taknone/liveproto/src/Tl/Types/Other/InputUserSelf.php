<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return InputUser
 */

final class InputUserSelf extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf7c1b13f);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>