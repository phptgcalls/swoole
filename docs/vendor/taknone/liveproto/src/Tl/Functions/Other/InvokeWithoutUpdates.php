<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param x query
 * @return X
 */

final class InvokeWithoutUpdates extends Instance {
	public function request(object $query) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbf9459b7);
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