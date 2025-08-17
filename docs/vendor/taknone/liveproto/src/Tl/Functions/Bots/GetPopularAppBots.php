<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string offset int limit
 * @return bots.PopularAppBots
 */

final class GetPopularAppBots extends Instance {
	public function request(string $offset,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc2510192);
		$writer->tgwriteBytes($offset);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>