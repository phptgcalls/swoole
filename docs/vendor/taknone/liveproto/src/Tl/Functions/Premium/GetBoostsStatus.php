<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Premium;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer
 * @return premium.BoostsStatus
 */

final class GetBoostsStatus extends Instance {
	public function request(object $peer) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x42f1f61);
		$writer->write($peer->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>