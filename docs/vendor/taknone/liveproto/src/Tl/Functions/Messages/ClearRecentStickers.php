<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true attached
 * @return Bool
 */

final class ClearRecentStickers extends Instance {
	public function request(? true $attached = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8999602d);
		$flags = 0;
		$flags |= is_null($attached) ? 0 : (1 << 0);
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