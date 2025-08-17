<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int ttl_seconds
 * @return secret.DecryptedMessageAction
 */

final class DecryptedMessageActionSetMessageTTL extends Instance {
	public function request(int $ttl_seconds) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa1733aec);
		$writer->writeInt($ttl_seconds);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['ttl_seconds'] = $reader->readInt();
		return new self($result);
	}
}

?>