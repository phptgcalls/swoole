<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputprivacykey key
 * @return account.PrivacyRules
 */

final class GetPrivacy extends Instance {
	public function request(object $key) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdadbc950);
		$writer->write($key->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>