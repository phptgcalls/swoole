<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<ConnectedBot> connected_bots Vector<User> users
 * @return account.ConnectedBots
 */

final class ConnectedBots extends Instance {
	public function request(array $connected_bots,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x17d7f87b);
		$writer->tgwriteVector($connected_bots,'ConnectedBot');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['connected_bots'] = $reader->tgreadVector('ConnectedBot');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>