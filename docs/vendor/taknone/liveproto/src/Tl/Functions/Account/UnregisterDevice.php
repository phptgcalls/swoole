<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int token_type string token Vector<long> other_uids
 * @return Bool
 */

final class UnregisterDevice extends Instance {
	public function request(int $token_type,string $token,array $other_uids) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6a0d3206);
		$writer->writeInt($token_type);
		$writer->tgwriteBytes($token);
		$writer->tgwriteVector($other_uids,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>