<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<JSONObjectValue> value
 * @return JSONValue
 */

final class JsonObject extends Instance {
	public function request(array $value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x99c1d49d);
		$writer->tgwriteVector($value,'JSONObjectValue');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['value'] = $reader->tgreadVector('JSONObjectValue');
		return new self($result);
	}
}

?>