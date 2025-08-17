<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Chat> chats
 * @return messages.Chats
 */

final class Chats extends Instance {
	public function request(array $chats) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x64ff9fd5);
		$writer->tgwriteVector($chats,'Chat');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chats'] = $reader->tgreadVector('Chat');
		return new self($result);
	}
}

?>