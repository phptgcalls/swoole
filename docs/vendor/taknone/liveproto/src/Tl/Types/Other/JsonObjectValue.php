<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string key jsonvalue value
 * @return JSONObjectValue
 */

final class JsonObjectValue extends Instance {
	public function request(string $key,object $value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc0de1bd9);
		$writer->tgwriteBytes($key);
		$writer->write($value->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['key'] = $reader->tgreadBytes();
		$result['value'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>