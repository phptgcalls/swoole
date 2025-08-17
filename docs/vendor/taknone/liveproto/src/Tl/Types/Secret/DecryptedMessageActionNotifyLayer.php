<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int layer
 * @return secret.DecryptedMessageAction
 */

final class DecryptedMessageActionNotifyLayer extends Instance {
	public function request(int $layer) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf3048883);
		$writer->writeInt($layer);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['layer'] = $reader->readInt();
		return new self($result);
	}
}

?>