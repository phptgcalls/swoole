<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int128 nonce int128 server_nonce long retry_id string g_b
 * @return Client_DH_Inner_Data
 */

final class ClientDHInnerData extends Instance {
	public function request(int | string $nonce,int | string $server_nonce,int $retry_id,string $g_b) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6643b654);
		$writer->writeLargeInt($nonce,128);
		$writer->writeLargeInt($server_nonce,128);
		$writer->writeLong($retry_id);
		$writer->tgwriteBytes($g_b);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['nonce'] = $reader->readLargeInt(128);
		$result['server_nonce'] = $reader->readLargeInt(128);
		$result['retry_id'] = $reader->readLong();
		$result['g_b'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>