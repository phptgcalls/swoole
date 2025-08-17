<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id
 * @return Peer
 */

final class PeerChat extends Instance {
	public function request(int $chat_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x36c6019a);
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