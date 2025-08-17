<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<PeerBlocked> blocked Vector<Chat> chats Vector<User> users
 * @return contacts.Blocked
 */

final class BlockedSlice extends Instance {
	public function request(int $count,array $blocked,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe1664194);
		$writer->writeInt($count);
		$writer->tgwriteVector($blocked,'PeerBlocked');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['blocked'] = $reader->tgreadVector('PeerBlocked');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>