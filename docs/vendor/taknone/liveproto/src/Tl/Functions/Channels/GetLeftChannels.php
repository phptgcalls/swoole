<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int offset
 * @return messages.Chats
 */

final class GetLeftChannels extends Instance {
	public function request(int $offset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8341ecc0);
		$writer->writeInt($offset);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>