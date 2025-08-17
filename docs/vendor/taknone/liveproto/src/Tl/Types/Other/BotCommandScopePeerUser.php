<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputuser user_id
 * @return BotCommandScope
 */

final class BotCommandScopePeerUser extends Instance {
	public function request(object $peer,object $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa1321f3);
		$writer->write($peer->read());
		$writer->write($user_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['user_id'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>