<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<SponsoredPeer> peers Vector<Chat> chats Vector<User> users
 * @return contacts.SponsoredPeers
 */

final class SponsoredPeers extends Instance {
	public function request(array $peers,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xeb032884);
		$writer->tgwriteVector($peers,'SponsoredPeer');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peers'] = $reader->tgreadVector('SponsoredPeer');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>