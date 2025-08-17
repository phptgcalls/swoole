<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes random
 * @return messages.DhConfig
 */

final class DhConfigNotModified extends Instance {
	public function request(string $random) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc0e24635);
		$writer->tgwriteBytes($random);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['random'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>