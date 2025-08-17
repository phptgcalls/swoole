<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param double value
 * @return JSONValue
 */

final class JsonNumber extends Instance {
	public function request(float $value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2be0dfa4);
		$writer->writeDouble($value);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['value'] = $reader->readDouble();
		return new self($result);
	}
}

?>