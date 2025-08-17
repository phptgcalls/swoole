<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Smsjobs;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true allow_international
 * @return Bool
 */

final class UpdateSettings extends Instance {
	public function request(? true $allow_international = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x93fa0bf);
		$flags = 0;
		$flags |= is_null($allow_international) ? 0 : (1 << 0);
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