<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string value
 * @return JSONValue
 */

final class JsonString extends Instance {
	public function request(string $value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb71e767a);
		$writer->tgwriteBytes($value);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['value'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>