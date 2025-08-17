<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer monoforum_peer_id
 * @return InputReplyTo
 */

final class InputReplyToMonoForum extends Instance {
	public function request(object $monoforum_peer_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x69d66c45);
		$writer->write($monoforum_peer_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['monoforum_peer_id'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>