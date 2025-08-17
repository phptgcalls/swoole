<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return PrivacyKey
 */

final class PrivacyKeyAddedByPhone extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x42ffd42b);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>