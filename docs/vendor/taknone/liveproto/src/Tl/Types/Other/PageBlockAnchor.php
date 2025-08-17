<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string name
 * @return PageBlock
 */

final class PageBlockAnchor extends Instance {
	public function request(string $name) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xce0d37b0);
		$writer->tgwriteBytes($name);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['name'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>