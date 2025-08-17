<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int onlines
 * @return ChatOnlines
 */

final class ChatOnlines extends Instance {
	public function request(int $onlines) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf041e250);
		$writer->writeInt($onlines);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['onlines'] = $reader->readInt();
		return new self($result);
	}
}

?>