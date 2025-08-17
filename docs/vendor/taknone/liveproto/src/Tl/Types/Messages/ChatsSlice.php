<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<Chat> chats
 * @return messages.Chats
 */

final class ChatsSlice extends Instance {
	public function request(int $count,array $chats) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9cd81144);
		$writer->writeInt($count);
		$writer->tgwriteVector($chats,'Chat');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['chats'] = $reader->tgreadVector('Chat');
		return new self($result);
	}
}

?>