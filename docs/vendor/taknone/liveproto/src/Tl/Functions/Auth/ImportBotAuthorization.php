<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int flags int api_id string api_hash string bot_auth_token
 * @return auth.Authorization
 */

final class ImportBotAuthorization extends Instance {
	public function request(int $flags,int $api_id,string $api_hash,string $bot_auth_token) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x67a3ff2c);
		$writer->writeInt($flags);
		$writer->writeInt($api_id);
		$writer->tgwriteBytes($api_hash);
		$writer->tgwriteBytes($bot_auth_token);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>