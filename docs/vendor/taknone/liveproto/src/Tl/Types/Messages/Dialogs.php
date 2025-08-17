<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Dialog> dialogs Vector<Message> messages Vector<Chat> chats Vector<User> users
 * @return messages.Dialogs
 */

final class Dialogs extends Instance {
	public function request(array $dialogs,array $messages,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x15ba6c40);
		$writer->tgwriteVector($dialogs,'Dialog');
		$writer->tgwriteVector($messages,'Message');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['dialogs'] = $reader->tgreadVector('Dialog');
		$result['messages'] = $reader->tgreadVector('Message');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>