<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputphonecall peer datajson debug
 * @return Bool
 */

final class SaveCallDebug extends Instance {
	public function request(object $peer,object $debug) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x277add7e);
		$writer->write($peer->read());
		$writer->write($debug->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>