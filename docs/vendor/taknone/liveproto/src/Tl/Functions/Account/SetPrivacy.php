<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputprivacykey key Vector<InputPrivacyRule> rules
 * @return account.PrivacyRules
 */

final class SetPrivacy extends Instance {
	public function request(object $key,array $rules) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc9f81ce8);
		$writer->write($key->read());
		$writer->tgwriteVector($rules,'InputPrivacyRule');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>