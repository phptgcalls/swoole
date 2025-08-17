<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return account.SavedRingtone
 */

final class SavedRingtone extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb7263f6d);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>