<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int retry_date
 * @return account.ResetPasswordResult
 */

final class ResetPasswordFailedWait extends Instance {
	public function request(int $retry_date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe3779861);
		$writer->writeInt($retry_date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['retry_date'] = $reader->readInt();
		return new self($result);
	}
}

?>