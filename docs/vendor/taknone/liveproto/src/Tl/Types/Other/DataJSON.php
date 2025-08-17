<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string data
 * @return DataJSON
 */

final class DataJSON extends Instance {
	public function request(string $data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7d748d04);
		$writer->tgwriteBytes($data);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['data'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>