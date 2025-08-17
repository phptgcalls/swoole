<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int128 nonce int128 server_nonce string encrypted_data
 * @return Set_client_DH_params_answer
 */

final class SetClientDHParams extends Instance {
	public function request(int | string $nonce,int | string $server_nonce,string $encrypted_data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf5045f1f);
		$writer->writeLargeInt($nonce,128);
		$writer->writeLargeInt($server_nonce,128);
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