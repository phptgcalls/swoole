<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return messages.AvailableEffects
 */

final class AvailableEffectsNotModified extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd1ed9a5b);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>