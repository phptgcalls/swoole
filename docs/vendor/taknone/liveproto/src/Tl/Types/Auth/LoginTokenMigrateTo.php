<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int dc_id bytes token
 * @return auth.LoginToken
 */

final class LoginTokenMigrateTo extends Instance {
	public function request(int $dc_id,string $token) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x68e9916);
		$writer->writeInt($dc_id);
		$writer->tgwriteBytes($token);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['dc_id'] = $reader->readInt();
		$result['token'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>