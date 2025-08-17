<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string key string value
 * @return LangPackString
 */

final class LangPackString extends Instance {
	public function request(string $key,string $value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcad181f6);
		$writer->tgwriteBytes($key);
		$writer->tgwriteBytes($value);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['key'] = $reader->tgreadBytes();
		$result['value'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>