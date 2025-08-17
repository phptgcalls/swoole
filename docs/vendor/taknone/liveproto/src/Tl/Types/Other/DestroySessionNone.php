<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long session_id
 * @return DestroySessionRes
 */

final class DestroySessionNone extends Instance {
	public function request(int $session_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x62d350c9);
		$writer->writeLong($session_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['session_id'] = $reader->readLong();
		return new self($result);
	}
}

?>