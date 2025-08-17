<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<SavedDialog> dialogs Vector<Message> messages Vector<Chat> chats Vector<User> users
 * @return messages.SavedDialogs
 */

final class SavedDialogsSlice extends Instance {
	public function request(int $count,array $dialogs,array $messages,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x44ba9dd9);
		$writer->writeInt($count);
		$writer->tgwriteVector($dialogs,'SavedDialog');
		$writer->tgwriteVector($messages,'Message');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['dialogs'] = $reader->tgreadVector('SavedDialog');
		$result['messages'] = $reader->tgreadVector('Message');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>