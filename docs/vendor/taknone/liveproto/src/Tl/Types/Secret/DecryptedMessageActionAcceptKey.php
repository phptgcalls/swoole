<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long exchange_id bytes g_b long key_fingerprint
 * @return secret.DecryptedMessageAction
 */

final class DecryptedMessageActionAcceptKey extends Instance {
	public function request(int $exchange_id,string $g_b,int $key_fingerprint) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6fe1735b);
		$writer->writeLong($exchange_id);
		$writer->tgwriteBytes($g_b);
		$writer->writeLong($key_fingerprint);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['exchange_id'] = $reader->readLong();
		$result['g_b'] = $reader->tgreadBytes();
		$result['key_fingerprint'] = $reader->readLong();
		return new self($result);
	}
}

?>