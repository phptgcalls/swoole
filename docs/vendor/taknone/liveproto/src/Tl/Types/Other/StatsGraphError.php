<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string error
 * @return StatsGraph
 */

final class StatsGraphError extends Instance {
	public function request(string $error) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbedc9822);
		$writer->tgwriteBytes($error);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['error'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>