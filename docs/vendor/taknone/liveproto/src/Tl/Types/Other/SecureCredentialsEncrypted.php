<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes data bytes hash bytes secret
 * @return SecureCredentialsEncrypted
 */

final class SecureCredentialsEncrypted extends Instance {
	public function request(string $data,string $hash,string $secret) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x33f0ea47);
		$writer->tgwriteBytes($data);
		$writer->tgwriteBytes($hash);
		$writer->tgwriteBytes($secret);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['data'] = $reader->tgreadBytes();
		$result['hash'] = $reader->tgreadBytes();
		$result['secret'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>