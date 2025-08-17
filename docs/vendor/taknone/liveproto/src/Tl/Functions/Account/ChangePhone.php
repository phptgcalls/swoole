<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string phone_code_hash string phone_code
 * @return User
 */

final class ChangePhone extends Instance {
	public function request(string $phone_number,string $phone_code_hash,string $phone_code) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x70c32edb);
		$writer->tgwriteBytes($phone_number);
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