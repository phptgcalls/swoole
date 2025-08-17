<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int max_id
 * @return messages.AffectedMessages
 */

final class ReadHistory extends Instance {
	public function request(object $peer,int $max_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe306d3a);
		$writer->write($peer->read());
		$writer->writeInt($max_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>