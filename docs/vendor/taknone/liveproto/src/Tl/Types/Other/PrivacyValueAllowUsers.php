<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> users
 * @return PrivacyRule
 */

final class PrivacyValueAllowUsers extends Instance {
	public function request(array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb8905fb2);
		$writer->tgwriteVector($users,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['users'] = $reader->tgreadVector('long');
		return new self($result);
	}
}

?>