<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int until_date
 * @return account.ResetPasswordResult
 */

final class ResetPasswordRequestedWait extends Instance {
	public function request(int $until_date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe9effc7d);
		$writer->writeInt($until_date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['until_date'] = $reader->readInt();
		return new self($result);
	}
}

?>