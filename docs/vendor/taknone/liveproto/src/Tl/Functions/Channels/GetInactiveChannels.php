<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return messages.InactiveChats
 */

final class GetInactiveChannels extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x11e831ee);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>