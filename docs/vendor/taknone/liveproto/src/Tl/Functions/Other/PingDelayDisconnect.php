<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long ping_id int disconnect_delay
 * @return Pong
 */

final class PingDelayDisconnect extends Instance {
	public function request(int $ping_id,int $disconnect_delay) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf3427b8c);
		$writer->writeLong($ping_id);
		$writer->writeInt($disconnect_delay);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>