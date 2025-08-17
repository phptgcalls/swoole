<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputcheckpasswordsrp password int period
 * @return account.TmpPassword
 */

final class GetTmpPassword extends Instance {
	public function request(object $password,int $period) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x449e0b51);
		$writer->write($password->read());
		$writer->writeInt($period);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>