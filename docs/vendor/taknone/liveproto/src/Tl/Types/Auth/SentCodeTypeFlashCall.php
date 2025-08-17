<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string pattern
 * @return auth.SentCodeType
 */

final class SentCodeTypeFlashCall extends Instance {
	public function request(string $pattern) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xab03c6d9);
		$writer->tgwriteBytes($pattern);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['pattern'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>