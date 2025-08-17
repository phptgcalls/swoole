<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<SendAsPeer> peers Vector<Chat> chats Vector<User> users
 * @return channels.SendAsPeers
 */

final class SendAsPeers extends Instance {
	public function request(array $peers,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf496b0c6);
		$writer->tgwriteVector($peers,'SendAsPeer');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peers'] = $reader->tgreadVector('SendAsPeer');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>