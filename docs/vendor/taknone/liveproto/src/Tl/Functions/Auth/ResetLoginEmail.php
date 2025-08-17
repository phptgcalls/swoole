<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string phone_code_hash
 * @return auth.SentCode
 */

final class ResetLoginEmail extends Instance {
	public function request(string $phone_number,string $phone_code_hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7e960193);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($phone_code_hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>