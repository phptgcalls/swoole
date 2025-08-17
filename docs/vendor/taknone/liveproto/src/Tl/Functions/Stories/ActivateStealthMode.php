<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true past true future
 * @return Updates
 */

final class ActivateStealthMode extends Instance {
	public function request(? true $past = null,? true $future = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x57bbd166);
		$flags = 0;
		$flags |= is_null($past) ? 0 : (1 << 0);
		$flags |= is_null($future) ? 0 : (1 << 1);
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