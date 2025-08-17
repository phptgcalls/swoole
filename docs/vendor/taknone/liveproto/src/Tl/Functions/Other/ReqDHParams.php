<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int128 nonce int128 server_nonce string p string q long public_key_fingerprint string encrypted_data
 * @return Server_DH_Params
 */

final class ReqDHParams extends Instance {
	public function request(int | string $nonce,int | string $server_nonce,string $p,string $q,int $public_key_fingerprint,string $encrypted_data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd712e4be);
		$writer->writeLargeInt($nonce,128);
		$writer->writeLargeInt($server_nonce,128);
		$writer->tgwriteBytes($p);
		$writer->tgwriteBytes($q);
		$writer->writeLong($public_key_fingerprint);
		$writer->tgwriteBytes($encrypted_data);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>