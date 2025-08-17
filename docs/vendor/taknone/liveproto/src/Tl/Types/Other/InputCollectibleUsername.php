<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string username
 * @return InputCollectible
 */

final class InputCollectibleUsername extends Instance {
	public function request(string $username) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe39460a9);
		$writer->tgwriteBytes($username);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['username'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>