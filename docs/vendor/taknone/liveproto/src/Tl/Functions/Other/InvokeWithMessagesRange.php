<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param messagerange range x query
 * @return X
 */

final class InvokeWithMessagesRange extends Instance {
	public function request(object $range,object $query) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x365275f2);
		$writer->write($range->read());
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