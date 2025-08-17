<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Chatlists;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Peer> missing_peers Vector<Chat> chats Vector<User> users
 * @return chatlists.ChatlistUpdates
 */

final class ChatlistUpdates extends Instance {
	public function request(array $missing_peers,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x93bd878d);
		$writer->tgwriteVector($missing_peers,'Peer');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['missing_peers'] = $reader->tgreadVector('Peer');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>