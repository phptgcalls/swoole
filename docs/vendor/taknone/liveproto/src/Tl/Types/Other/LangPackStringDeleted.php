<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string key
 * @return LangPackString
 */

final class LangPackStringDeleted extends Instance {
	public function request(string $key) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2979eeb2);
		$writer->tgwriteBytes($key);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['key'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>