<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return InputPrivacyKey
 */

final class InputPrivacyKeyPhoneCall extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfabadc5f);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>