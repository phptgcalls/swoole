<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id
 * @return InputPeer
 */

final class InputPeerChat extends Instance {
	public function request(int $chat_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x35a95cb9);
		$writer->writeLong($chat_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chat_id'] = $reader->readLong();
		return new self($result);
	}
}

?>