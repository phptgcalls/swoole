<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long exchange_id long key_fingerprint
 * @return secret.DecryptedMessageAction
 */

final class DecryptedMessageActionCommitKey extends Instance {
	public function request(int $exchange_id,int $key_fingerprint) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xec2e0b9b);
		$writer->writeLong($exchange_id);
		$writer->writeLong($key_fingerprint);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['exchange_id'] = $reader->readLong();
		$result['key_fingerprint'] = $reader->readLong();
		return new self($result);
	}
}

?>