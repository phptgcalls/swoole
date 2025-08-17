<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<QuickReply> quick_replies Vector<Message> messages Vector<Chat> chats Vector<User> users
 * @return messages.QuickReplies
 */

final class QuickReplies extends Instance {
	public function request(array $quick_replies,array $messages,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc68d6695);
		$writer->tgwriteVector($quick_replies,'QuickReply');
		$writer->tgwriteVector($messages,'Message');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['quick_replies'] = $reader->tgreadVector('QuickReply');
		$result['messages'] = $reader->tgreadVector('Message');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>