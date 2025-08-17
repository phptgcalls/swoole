<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<MessageViews> views Vector<Chat> chats Vector<User> users
 * @return messages.MessageViews
 */

final class MessageViews extends Instance {
	public function request(array $views,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb6c4f543);
		$writer->tgwriteVector($views,'MessageViews');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['views'] = $reader->tgreadVector('MessageViews');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>