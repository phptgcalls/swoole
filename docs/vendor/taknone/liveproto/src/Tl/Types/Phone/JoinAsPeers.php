<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Peer> peers Vector<Chat> chats Vector<User> users
 * @return phone.JoinAsPeers
 */

final class JoinAsPeers extends Instance {
	public function request(array $peers,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xafe5623f);
		$writer->tgwriteVector($peers,'Peer');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peers'] = $reader->tgreadVector('Peer');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>