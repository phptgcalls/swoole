<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int authorization_ttl_days
 * @return Bool
 */

final class SetAuthorizationTTL extends Instance {
	public function request(int $authorization_ttl_days) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbf899aa0);
		$writer->writeInt($authorization_ttl_days);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>