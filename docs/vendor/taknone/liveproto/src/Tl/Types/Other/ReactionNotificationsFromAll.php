<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return ReactionNotificationsFrom
 */

final class ReactionNotificationsFromAll extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4b9e22a0);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>