<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int max_id
 * @return Vector<ReceivedNotifyMessage>
 */

final class ReceivedMessages extends Instance {
	public function request(int $max_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5a954c0);
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