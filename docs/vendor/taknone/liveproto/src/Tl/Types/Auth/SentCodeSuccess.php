<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param auth authorization
 * @return auth.SentCode
 */

final class SentCodeSuccess extends Instance {
	public function request(object $authorization) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2390fe44);
		$writer->write($authorization->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['authorization'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>