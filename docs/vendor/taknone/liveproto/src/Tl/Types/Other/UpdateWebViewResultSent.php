<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id
 * @return Update
 */

final class UpdateWebViewResultSent extends Instance {
	public function request(int $query_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1592b79d);
		$writer->writeLong($query_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['query_id'] = $reader->readLong();
		return new self($result);
	}
}

?>