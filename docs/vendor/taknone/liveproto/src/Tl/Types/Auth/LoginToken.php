<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int expires bytes token
 * @return auth.LoginToken
 */

final class LoginToken extends Instance {
	public function request(int $expires,string $token) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x629f1980);
		$writer->writeInt($expires);
		$writer->tgwriteBytes($token);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['expires'] = $reader->readInt();
		$result['token'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>