<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string prefix int length
 * @return auth.SentCodeType
 */

final class SentCodeTypeMissedCall extends Instance {
	public function request(string $prefix,int $length) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x82006484);
		$writer->tgwriteBytes($prefix);
		$writer->writeInt($length);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prefix'] = $reader->tgreadBytes();
		$result['length'] = $reader->readInt();
		return new self($result);
	}
}

?>