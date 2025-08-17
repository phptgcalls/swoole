<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true sensitive_enabled
 * @return Bool
 */

final class SetContentSettings extends Instance {
	public function request(? true $sensitive_enabled = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb574b16b);
		$flags = 0;
		$flags |= is_null($sensitive_enabled) ? 0 : (1 << 0);
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