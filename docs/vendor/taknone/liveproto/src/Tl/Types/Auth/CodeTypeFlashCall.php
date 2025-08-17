<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return auth.CodeType
 */

final class CodeTypeFlashCall extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x226ccefb);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>