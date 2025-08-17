<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int128 nonce int128 server_nonce int128 new_nonce_hash2
 * @return Set_client_DH_params_answer
 */

final class DhGenRetry extends Instance {
	public function request(int | string $nonce,int | string $server_nonce,int | string $new_nonce_hash2) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x46dc1fb9);
		$writer->writeLargeInt($nonce,128);
		$writer->writeLargeInt($server_nonce,128);
		$writer->writeLargeInt($new_nonce_hash2,128);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['nonce'] = $reader->readLargeInt(128);
		$result['server_nonce'] = $reader->readLargeInt(128);
		$result['new_nonce_hash2'] = $reader->readLargeInt(128);
		return new self($result);
	}
}

?>