<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<JSONValue> value
 * @return JSONValue
 */

final class JsonArray extends Instance {
	public function request(array $value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf7444763);
		$writer->tgwriteVector($value,'JSONValue');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['value'] = $reader->tgreadVector('JSONValue');
		return new self($result);
	}
}

?>