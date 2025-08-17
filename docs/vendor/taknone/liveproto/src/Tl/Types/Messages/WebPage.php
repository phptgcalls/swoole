<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param webpage webpage Vector<Chat> chats Vector<User> users
 * @return messages.WebPage
 */

final class WebPage extends Instance {
	public function request(object $webpage,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfd5e12bd);
		$writer->write($webpage->read());
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['webpage'] = $reader->tgreadObject();
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>