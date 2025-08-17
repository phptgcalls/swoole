<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string phone_code_hash string safety_net_token string play_integrity_token string ios_push_secret
 * @return Bool
 */

final class RequestFirebaseSms extends Instance {
	public function request(string $phone_number,string $phone_code_hash,? string $safety_net_token = null,? string $play_integrity_token = null,? string $ios_push_secret = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8e39261e);
		$flags = 0;
		$flags |= is_null($safety_net_token) ? 0 : (1 << 0);
		$flags |= is_null($play_integrity_token) ? 0 : (1 << 2);
		$flags |= is_null($ios_push_secret) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($phone_code_hash);
		if(is_null($safety_net_token) === false):
			$writer->tgwriteBytes($safety_net_token);
		endif;
		if(is_null($play_integrity_token) === false):
			$writer->tgwriteBytes($play_integrity_token);
		endif;
		if(is_null($ios_push_secret) === false):
			$writer->tgwriteBytes($ios_push_secret);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>