<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int max_qts
 * @return Vector<long>
 */

final class ReceivedQueue extends Instance {
	public function request(int $max_qts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x55a5bb66);
		$writer->writeInt($max_qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>