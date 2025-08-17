<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Users;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<User> users
 * @return users.Users
 */

final class UsersSlice extends Instance {
	public function request(int $count,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x315a4974);
		$writer->writeInt($count);
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>