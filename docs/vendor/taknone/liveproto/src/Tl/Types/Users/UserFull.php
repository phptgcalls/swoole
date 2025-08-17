<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Users;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param userfull full_user Vector<Chat> chats Vector<User> users
 * @return users.UserFull
 */

final class UserFull extends Instance {
	public function request(object $full_user,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3b6d152e);
		$writer->write($full_user->read());
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['full_user'] = $reader->tgreadObject();
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>