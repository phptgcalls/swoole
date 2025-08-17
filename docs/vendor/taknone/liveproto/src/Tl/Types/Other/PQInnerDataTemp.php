<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string pq string p string q int128 nonce int128 server_nonce int256 new_nonce int expires_in
 * @return P_Q_inner_data
 */

final class PQInnerDataTemp extends Instance {
	public function request(string $pq,string $p,string $q,int | string $nonce,int | string $server_nonce,int | string $new_nonce,int $expires_in) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3c6a84d4);
		$writer->tgwriteBytes($pq);
		$writer->tgwriteBytes($p);
		$writer->tgwriteBytes($q);
		$writer->writeLargeInt($nonce,128);
		$writer->writeLargeInt($server_nonce,128);
		$writer->writeLargeInt($new_nonce,256);
		$writer->writeInt($expires_in);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['pq'] = $reader->tgreadBytes();
		$result['p'] = $reader->tgreadBytes();
		$result['q'] = $reader->tgreadBytes();
		$result['nonce'] = $reader->readLargeInt(128);
		$result['server_nonce'] = $reader->readLargeInt(128);
		$result['new_nonce'] = $reader->readLargeInt(256);
		$result['expires_in'] = $reader->readInt();
		return new self($result);
	}
}

?>