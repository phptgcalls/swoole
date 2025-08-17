<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long session_id
 * @return DestroySessionRes
 */

final class DestroySession extends Instance {
	public function request(int $session_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe7512126);
		$writer->writeLong($session_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>