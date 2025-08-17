<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<TopPeerCategoryPeers> categories Vector<Chat> chats Vector<User> users
 * @return contacts.TopPeers
 */

final class TopPeers extends Instance {
	public function request(array $categories,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x70b772a8);
		$writer->tgwriteVector($categories,'TopPeerCategoryPeers');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['categories'] = $reader->tgreadVector('TopPeerCategoryPeers');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>