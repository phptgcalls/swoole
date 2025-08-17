<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes token
 * @return auth.LoginToken
 */

final class ImportLoginToken extends Instance {
	public function request(string $token) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x95ac5ce4);
		$writer->tgwriteBytes($token);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>