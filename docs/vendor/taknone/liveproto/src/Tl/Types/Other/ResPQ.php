<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int128 nonce int128 server_nonce string pq Vector<long> server_public_key_fingerprints
 * @return ResPQ
 */

final class ResPQ extends Instance {
	public function request(int | string $nonce,int | string $server_nonce,string $pq,array $server_public_key_fingerprints) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5162463);
		$writer->writeLargeInt($nonce,128);
		$writer->writeLargeInt($server_nonce,128);
		$writer->tgwriteBytes($pq);
		$writer->tgwriteVector($server_public_key_fingerprints,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['nonce'] = $reader->readLargeInt(128);
		$result['server_nonce'] = $reader->readLargeInt(128);
		$result['pq'] = $reader->tgreadBytes();
		$result['server_public_key_fingerprints'] = $reader->tgreadVector('long');
		return new self($result);
	}
}

?>