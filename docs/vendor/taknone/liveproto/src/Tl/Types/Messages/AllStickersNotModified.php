<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return messages.AllStickers
 */

final class AllStickersNotModified extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe86602c3);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>