<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<int> dates Vector<Chat> chats Vector<User> users
 * @return messages.InactiveChats
 */

final class InactiveChats extends Instance {
	public function request(array $dates,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa927fec5);
		$writer->tgwriteVector($dates,'int');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['dates'] = $reader->tgreadVector('int');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>