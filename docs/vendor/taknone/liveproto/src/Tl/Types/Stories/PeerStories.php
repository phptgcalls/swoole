<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peerstories stories Vector<Chat> chats Vector<User> users
 * @return stories.PeerStories
 */

final class PeerStories extends Instance {
	public function request(object $stories,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcae68768);
		$writer->write($stories->read());
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['stories'] = $reader->tgreadObject();
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>