<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputUser> users
 * @return InputPrivacyRule
 */

final class InputPrivacyValueAllowUsers extends Instance {
	public function request(array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x131cc67f);
		$writer->tgwriteVector($users,'InputUser');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['users'] = $reader->tgreadVector('InputUser');
		return new self($result);
	}
}

?>