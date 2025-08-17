<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bool value
 * @return JSONValue
 */

final class JsonBool extends Instance {
	public function request(bool $value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc7345e6a);
		$writer->tgwriteBool($value);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['value'] = $reader->tgreadBool();
		return new self($result);
	}
}

?>