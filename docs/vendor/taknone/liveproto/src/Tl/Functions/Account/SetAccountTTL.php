<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param accountdaysttl ttl
 * @return Bool
 */

final class SetAccountTTL extends Instance {
	public function request(object $ttl) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2442485e);
		$writer->write($ttl->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>