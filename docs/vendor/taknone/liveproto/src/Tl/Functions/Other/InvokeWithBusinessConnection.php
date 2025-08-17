<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string connection_id x query
 * @return X
 */

final class InvokeWithBusinessConnection extends Instance {
	public function request(string $connection_id,object $query) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdd289f8e);
		$writer->tgwriteBytes($connection_id);
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