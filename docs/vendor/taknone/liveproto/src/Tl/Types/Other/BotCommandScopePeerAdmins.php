<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer
 * @return BotCommandScope
 */

final class BotCommandScopePeerAdmins extends Instance {
	public function request(object $peer) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3fd863d1);
		$writer->write($peer->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>