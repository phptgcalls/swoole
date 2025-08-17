<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string phone_code_hash
 * @return EmailVerifyPurpose
 */

final class EmailVerifyPurposeLoginSetup extends Instance {
	public function request(string $phone_number,string $phone_code_hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4345be73);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($phone_code_hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['phone_number'] = $reader->tgreadBytes();
		$result['phone_code_hash'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>