<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<AttachMenuBot> bots Vector<User> users
 * @return AttachMenuBots
 */

final class AttachMenuBots extends Instance {
	public function request(int $hash,array $bots,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3c4301c0);
		$writer->writeLong($hash);
		$writer->tgwriteVector($bots,'AttachMenuBot');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['bots'] = $reader->tgreadVector('AttachMenuBot');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>