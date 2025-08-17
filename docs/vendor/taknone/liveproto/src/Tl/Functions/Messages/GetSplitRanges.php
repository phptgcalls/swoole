<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return Vector<MessageRange>
 */

final class GetSplitRanges extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1cff7e08);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>