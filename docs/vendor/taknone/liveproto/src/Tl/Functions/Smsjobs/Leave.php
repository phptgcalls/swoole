<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Smsjobs;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return Bool
 */

final class Leave extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9898ad73);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>