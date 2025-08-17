<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string token x query
 * @return X
 */

final class InvokeWithReCaptcha extends Instance {
	public function request(string $token,object $query) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xadbb0f94);
		$writer->tgwriteBytes($token);
		$writer->write($query->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>