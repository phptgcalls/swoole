<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer bool paused
 * @return Bool
 */

final class ToggleConnectedBotPaused extends Instance {
	public function request(object $peer,bool $paused) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x646e1097);
		$writer->write($peer->read());
		$writer->tgwriteBool($paused);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>