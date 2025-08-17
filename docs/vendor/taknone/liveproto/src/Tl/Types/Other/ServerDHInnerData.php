<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int128 nonce int128 server_nonce int g string dh_prime string g_a int server_time
 * @return Server_DH_inner_data
 */

final class ServerDHInnerData extends Instance {
	public function request(int | string $nonce,int | string $server_nonce,int $g,string $dh_prime,string $g_a,int $server_time) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb5890dba);
		$writer->writeLargeInt($nonce,128);
		$writer->writeLargeInt($server_nonce,128);
		$writer->writeInt($g);
		$writer->tgwriteBytes($dh_prime);
		$writer->tgwriteBytes($g_a);
		$writer->writeInt($server_time);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['nonce'] = $reader->readLargeInt(128);
		$result['server_nonce'] = $reader->readLargeInt(128);
		$result['g'] = $reader->readInt();
		$result['dh_prime'] = $reader->tgreadBytes();
		$result['g_a'] = $reader->tgreadBytes();
		$result['server_time'] = $reader->readInt();
		return new self($result);
	}
}

?>