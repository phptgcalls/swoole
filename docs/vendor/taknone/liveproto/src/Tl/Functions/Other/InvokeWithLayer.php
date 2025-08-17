<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int layer x query
 * @return X
 */

final class InvokeWithLayer extends Instance {
	public function request(int $layer,object $query) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xda9b0d0d);
		$writer->writeInt($layer);
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