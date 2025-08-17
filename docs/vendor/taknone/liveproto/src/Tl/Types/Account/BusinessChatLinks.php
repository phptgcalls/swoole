<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<BusinessChatLink> links Vector<Chat> chats Vector<User> users
 * @return account.BusinessChatLinks
 */

final class BusinessChatLinks extends Instance {
	public function request(array $links,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xec43a2d1);
		$writer->tgwriteVector($links,'BusinessChatLink');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['links'] = $reader->tgreadVector('BusinessChatLink');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>