<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return help.AppUpdate
 */

final class NoAppUpdate extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc45a6536);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>