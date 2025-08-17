<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true credentials true info
 * @return Bool
 */

final class ClearSavedInfo extends Instance {
	public function request(? true $credentials = null,? true $info = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd83d70c1);
		$flags = 0;
		$flags |= is_null($credentials) ? 0 : (1 << 0);
		$flags |= is_null($info) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>