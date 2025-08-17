<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return Updates
 */

final class UpdatesTooLong extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe317af7e);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>