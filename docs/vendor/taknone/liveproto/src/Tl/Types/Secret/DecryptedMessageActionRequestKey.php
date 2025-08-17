<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long exchange_id bytes g_a
 * @return secret.DecryptedMessageAction
 */

final class DecryptedMessageActionRequestKey extends Instance {
	public function request(int $exchange_id,string $g_a) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf3c9611b);
		$writer->writeLong($exchange_id);
		$writer->tgwriteBytes($g_a);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['exchange_id'] = $reader->readLong();
		$result['g_a'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>