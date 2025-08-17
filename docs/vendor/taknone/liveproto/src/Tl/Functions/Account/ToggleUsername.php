<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string username bool active
 * @return Bool
 */

final class ToggleUsername extends Instance {
	public function request(string $username,bool $active) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x58d6b376);
		$writer->tgwriteBytes($username);
		$writer->tgwriteBool($active);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>