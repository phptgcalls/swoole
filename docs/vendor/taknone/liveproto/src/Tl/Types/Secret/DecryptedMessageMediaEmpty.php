<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return secret.DecryptedMessageMedia
 */

final class DecryptedMessageMediaEmpty extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x89f5c4a);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>