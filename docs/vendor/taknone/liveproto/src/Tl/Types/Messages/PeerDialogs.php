<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Dialog> dialogs Vector<Message> messages Vector<Chat> chats Vector<User> users updates state
 * @return messages.PeerDialogs
 */

final class PeerDialogs extends Instance {
	public function request(array $dialogs,array $messages,array $chats,array $users,object $state) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3371c354);
		$writer->tgwriteVector($dialogs,'Dialog');
		$writer->tgwriteVector($messages,'Message');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		$writer->write($state->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['dialogs'] = $reader->tgreadVector('Dialog');
		$result['messages'] = $reader->tgreadVector('Message');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		$result['state'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>