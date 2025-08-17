<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stats;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel true dark
 * @return stats.BroadcastStats
 */

final class GetBroadcastStats extends Instance {
	public function request(object $channel,? true $dark = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xab42441a);
		$flags = 0;
		$flags |= is_null($dark) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>