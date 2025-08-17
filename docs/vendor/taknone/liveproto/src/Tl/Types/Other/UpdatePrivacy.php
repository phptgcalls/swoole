<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param privacykey key Vector<PrivacyRule> rules
 * @return Update
 */

final class UpdatePrivacy extends Instance {
	public function request(object $key,array $rules) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xee3b272a);
		$writer->write($key->read());
		$writer->tgwriteVector($rules,'PrivacyRule');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['key'] = $reader->tgreadObject();
		$result['rules'] = $reader->tgreadVector('PrivacyRule');
		return new self($result);
	}
}

?>