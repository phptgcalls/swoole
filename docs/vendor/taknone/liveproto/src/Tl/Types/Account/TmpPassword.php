<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes tmp_password int valid_until
 * @return account.TmpPassword
 */

final class TmpPassword extends Instance {
	public function request(string $tmp_password,int $valid_until) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdb64fd34);
		$writer->tgwriteBytes($tmp_password);
		$writer->writeInt($valid_until);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['tmp_password'] = $reader->tgreadBytes();
		$result['valid_until'] = $reader->readInt();
		return new self($result);
	}
}

?>