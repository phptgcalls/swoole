<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Updates;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Message> new_messages Vector<EncryptedMessage> new_encrypted_messages Vector<Update> other_updates Vector<Chat> chats Vector<User> users updates state
 * @return updates.Difference
 */

final class Difference extends Instance {
	public function request(array $new_messages,array $new_encrypted_messages,array $other_updates,array $chats,array $users,object $state) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf49ca0);
		$writer->tgwriteVector($new_messages,'Message');
		$writer->tgwriteVector($new_encrypted_messages,'EncryptedMessage');
		$writer->tgwriteVector($other_updates,'Update');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		$writer->write($state->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['new_messages'] = $reader->tgreadVector('Message');
		$result['new_encrypted_messages'] = $reader->tgreadVector('EncryptedMessage');
		$result['other_updates'] = $reader->tgreadVector('Update');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		$result['state'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>