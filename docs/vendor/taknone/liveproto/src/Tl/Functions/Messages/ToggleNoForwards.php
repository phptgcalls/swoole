<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer bool enabled
 * @return Updates
 */

final class ToggleNoForwards extends Instance {
	public function request(object $peer,bool $enabled) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb11eafa2);
		$writer->write($peer->read());
		$writer->tgwriteBool($enabled);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>