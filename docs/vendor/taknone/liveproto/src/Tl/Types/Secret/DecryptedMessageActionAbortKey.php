<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long exchange_id
 * @return secret.DecryptedMessageAction
 */

final class DecryptedMessageActionAbortKey extends Instance {
	public function request(int $exchange_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdd05ec6b);
		$writer->writeLong($exchange_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['exchange_id'] = $reader->readLong();
		return new self($result);
	}
}

?>