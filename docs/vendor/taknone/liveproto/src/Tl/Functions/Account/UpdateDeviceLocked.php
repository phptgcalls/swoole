<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int period
 * @return Bool
 */

final class UpdateDeviceLocked extends Instance {
	public function request(int $period) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x38df3532);
		$writer->writeInt($period);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>