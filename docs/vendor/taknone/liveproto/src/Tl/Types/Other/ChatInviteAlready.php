<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param chat chat
 * @return ChatInvite
 */

final class ChatInviteAlready extends Instance {
	public function request(object $chat) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5a686d7c);
		$writer->write($chat->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chat'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>