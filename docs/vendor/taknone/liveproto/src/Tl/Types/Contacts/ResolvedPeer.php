<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer Vector<Chat> chats Vector<User> users
 * @return contacts.ResolvedPeer
 */

final class ResolvedPeer extends Instance {
	public function request(object $peer,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7f077ad9);
		$writer->write($peer->read());
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>