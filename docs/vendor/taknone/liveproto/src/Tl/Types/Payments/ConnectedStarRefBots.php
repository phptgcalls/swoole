<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<ConnectedBotStarRef> connected_bots Vector<User> users
 * @return payments.ConnectedStarRefBots
 */

final class ConnectedStarRefBots extends Instance {
	public function request(int $count,array $connected_bots,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x98d5ea1d);
		$writer->writeInt($count);
		$writer->tgwriteVector($connected_bots,'ConnectedBotStarRef');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['connected_bots'] = $reader->tgreadVector('ConnectedBotStarRef');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>