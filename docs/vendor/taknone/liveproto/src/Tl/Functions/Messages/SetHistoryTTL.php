<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int period
 * @return Updates
 */

final class SetHistoryTTL extends Instance {
	public function request(object $peer,int $period) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb80e5fe4);
		$writer->write($peer->read());
		$writer->writeInt($period);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>