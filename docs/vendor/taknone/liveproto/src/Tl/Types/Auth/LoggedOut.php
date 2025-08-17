<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes future_auth_token
 * @return auth.LoggedOut
 */

final class LoggedOut extends Instance {
	public function request(? string $future_auth_token = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc3a2835f);
		$flags = 0;
		$flags |= is_null($future_auth_token) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($future_auth_token) === false):
			$writer->tgwriteBytes($future_auth_token);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['future_auth_token'] = $reader->tgreadBytes();
		else:
			$result['future_auth_token'] = null;
		endif;
		return new self($result);
	}
}

?>