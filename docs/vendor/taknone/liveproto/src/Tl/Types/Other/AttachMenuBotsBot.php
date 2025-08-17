<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param attachmenubot bot Vector<User> users
 * @return AttachMenuBotsBot
 */

final class AttachMenuBotsBot extends Instance {
	public function request(object $bot,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x93bf667f);
		$writer->write($bot->read());
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['bot'] = $reader->tgreadObject();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>