<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Peer> my_results Vector<Peer> results Vector<Chat> chats Vector<User> users
 * @return contacts.Found
 */

final class Found extends Instance {
	public function request(array $my_results,array $results,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb3134d9d);
		$writer->tgwriteVector($my_results,'Peer');
		$writer->tgwriteVector($results,'Peer');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['my_results'] = $reader->tgreadVector('Peer');
		$result['results'] = $reader->tgreadVector('Peer');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>