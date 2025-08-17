<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string phone_code_hash string reason
 * @return auth.SentCode
 */

final class ResendCode extends Instance {
	public function request(string $phone_number,string $phone_code_hash,? string $reason = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcae47523);
		$flags = 0;
		$flags |= is_null($reason) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($phone_code_hash);
		if(is_null($reason) === false):
			$writer->tgwriteBytes($reason);
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