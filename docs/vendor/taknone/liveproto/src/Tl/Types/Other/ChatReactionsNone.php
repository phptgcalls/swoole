<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return ChatReactions
 */

final class ChatReactionsNone extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xeafc32bc);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>