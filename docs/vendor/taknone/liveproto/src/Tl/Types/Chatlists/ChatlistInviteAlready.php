<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Chatlists;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int filter_id Vector<Peer> missing_peers Vector<Peer> already_peers Vector<Chat> chats Vector<User> users
 * @return chatlists.ChatlistInvite
 */

final class ChatlistInviteAlready extends Instance {
	public function request(int $filter_id,array $missing_peers,array $already_peers,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfa87f659);
		$writer->writeInt($filter_id);
		$writer->tgwriteVector($missing_peers,'Peer');
		$writer->tgwriteVector($already_peers,'Peer');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['filter_id'] = $reader->readInt();
		$result['missing_peers'] = $reader->tgreadVector('Peer');
		$result['already_peers'] = $reader->tgreadVector('Peer');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>