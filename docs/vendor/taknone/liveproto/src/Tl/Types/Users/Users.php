<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Users;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<User> users
 * @return users.Users
 */

final class Users extends Instance {
	public function request(array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x62d706b8);
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>