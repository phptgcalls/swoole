<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int max_id
 * @return Vector<int>
 */

final class ReadStories extends Instance {
	public function request(object $peer,int $max_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa556dac8);
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