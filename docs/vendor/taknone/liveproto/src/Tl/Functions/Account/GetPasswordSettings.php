<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputcheckpasswordsrp password
 * @return account.PasswordSettings
 */

final class GetPasswordSettings extends Instance {
	public function request(object $password) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9cd4eaf9);
		$writer->write($password->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>