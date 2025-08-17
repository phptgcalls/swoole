<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true missed
 * @return MessagesFilter
 */

final class InputMessagesFilterPhoneCalls extends Instance {
	public function request(? true $missed = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x80c99768);
		$flags = 0;
		$flags |= is_null($missed) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['missed'] = true;
		else:
			$result['missed'] = false;
		endif;
		return new self($result);
	}
}

?>