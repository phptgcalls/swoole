<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputuser bot
 * @return payments.ConnectedStarRefBots
 */

final class ConnectStarRefBot extends Instance {
	public function request(object $peer,object $bot) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7ed5348a);
		$writer->write($peer->read());
		$writer->write($bot->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>