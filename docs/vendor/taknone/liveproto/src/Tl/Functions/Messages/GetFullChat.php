<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id
 * @return messages.ChatFull
 */

final class GetFullChat extends Instance {
	public function request(int $chat_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xaeb00b34);
		$writer->writeLong($chat_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>