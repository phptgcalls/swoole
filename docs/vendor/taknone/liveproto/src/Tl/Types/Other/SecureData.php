<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes data bytes data_hash bytes secret
 * @return SecureData
 */

final class SecureData extends Instance {
	public function request(string $data,string $data_hash,string $secret) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8aeabec3);
		$writer->tgwriteBytes($data);
		$writer->tgwriteBytes($data_hash);
		$writer->tgwriteBytes($secret);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['data'] = $reader->tgreadBytes();
		$result['data_hash'] = $reader->tgreadBytes();
		$result['secret'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>