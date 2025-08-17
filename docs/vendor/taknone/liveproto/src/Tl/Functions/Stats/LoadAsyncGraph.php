<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stats;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string token long x
 * @return StatsGraph
 */

final class LoadAsyncGraph extends Instance {
	public function request(string $token,? int $x = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x621d5fa0);
		$flags = 0;
		$flags |= is_null($x) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($token);
		if(is_null($x) === false):
			$writer->writeLong($x);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>