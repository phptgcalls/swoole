<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param chatfull full_chat Vector<Chat> chats Vector<User> users
 * @return messages.ChatFull
 */

final class ChatFull extends Instance {
	public function request(object $full_chat,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe5d7d19c);
		$writer->write($full_chat->read());
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['full_chat'] = $reader->tgreadObject();
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>