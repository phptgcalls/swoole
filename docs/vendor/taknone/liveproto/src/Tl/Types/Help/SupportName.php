<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string name
 * @return help.SupportName
 */

final class SupportName extends Instance {
	public function request(string $name) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8c05f1c9);
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