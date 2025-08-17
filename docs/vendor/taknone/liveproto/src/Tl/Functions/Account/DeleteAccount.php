<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string reason inputcheckpasswordsrp password
 * @return Bool
 */

final class DeleteAccount extends Instance {
	public function request(string $reason,? object $password = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa2c0cf74);
		$flags = 0;
		$flags |= is_null($password) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($reason);
		if(is_null($password) === false):
			$writer->write($password->read());
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