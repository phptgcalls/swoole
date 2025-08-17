<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param stargift gift Vector<User> users
 * @return payments.UniqueStarGift
 */

final class UniqueStarGift extends Instance {
	public function request(object $gift,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcaa2f60b);
		$writer->write($gift->read());
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['gift'] = $reader->tgreadObject();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>