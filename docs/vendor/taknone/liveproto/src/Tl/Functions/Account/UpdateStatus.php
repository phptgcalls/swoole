<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bool offline
 * @return Bool
 */

final class UpdateStatus extends Instance {
	public function request(bool $offline) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6628562c);
		$writer->tgwriteBool($offline);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>