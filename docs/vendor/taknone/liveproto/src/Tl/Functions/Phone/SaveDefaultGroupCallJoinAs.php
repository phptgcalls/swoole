<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputpeer join_as
 * @return Bool
 */

final class SaveDefaultGroupCallJoinAs extends Instance {
	public function request(object $peer,object $join_as) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x575e1f8c);
		$writer->write($peer->read());
		$writer->write($join_as->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>