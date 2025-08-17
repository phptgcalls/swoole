<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int min_id int max_id
 * @return MessageRange
 */

final class MessageRange extends Instance {
	public function request(int $min_id,int $max_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xae30253);
		$writer->writeInt($min_id);
		$writer->writeInt($max_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['min_id'] = $reader->readInt();
		$result['max_id'] = $reader->readInt();
		return new self($result);
	}
}

?>