<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return DestroyAuthKeyRes
 */

final class DestroyAuthKey extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd1435160);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>