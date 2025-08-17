<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputnotifypeer peer
 * @return PeerNotifySettings
 */

final class GetNotifySettings extends Instance {
	public function request(object $peer) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x12b3ad31);
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