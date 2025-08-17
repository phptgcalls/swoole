<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int length
 * @return auth.SentCodeType
 */

final class SentCodeTypeCall extends Instance {
	public function request(int $length) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5353e5a7);
		$writer->writeInt($length);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['length'] = $reader->readInt();
		return new self($result);
	}
}

?>