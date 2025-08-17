<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_code_hash string phone_code
 * @return Bool
 */

final class ConfirmPhone extends Instance {
	public function request(string $phone_code_hash,string $phone_code) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5f2178c3);
		$writer->tgwriteBytes($phone_code_hash);
		$writer->tgwriteBytes($phone_code);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>