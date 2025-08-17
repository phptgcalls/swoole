<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Updates;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return updates.State
 */

final class GetState extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xedd4882a);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>