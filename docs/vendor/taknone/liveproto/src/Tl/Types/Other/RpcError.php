<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int error_code string error_message
 * @return RpcError
 */

final class RpcError extends Instance {
	public function request(int $error_code,string $error_message) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2144ca19);
		$writer->writeInt($error_code);
		$writer->tgwriteBytes($error_message);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['error_code'] = $reader->readInt();
		$result['error_message'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>