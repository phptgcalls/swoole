<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string token
 * @return StatsGraph
 */

final class StatsGraphAsync extends Instance {
	public function request(string $token) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4a27eb2d);
		$writer->tgwriteBytes($token);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['token'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>