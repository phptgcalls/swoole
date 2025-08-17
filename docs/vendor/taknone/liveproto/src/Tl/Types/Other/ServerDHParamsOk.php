<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int128 nonce int128 server_nonce string encrypted_answer
 * @return Server_DH_Params
 */

final class ServerDHParamsOk extends Instance {
	public function request(int | string $nonce,int | string $server_nonce,string $encrypted_answer) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd0e8075c);
		$writer->writeLargeInt($nonce,128);
		$writer->writeLargeInt($server_nonce,128);
		$writer->tgwriteBytes($encrypted_answer);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['nonce'] = $reader->readLargeInt(128);
		$result['server_nonce'] = $reader->readLargeInt(128);
		$result['encrypted_answer'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>