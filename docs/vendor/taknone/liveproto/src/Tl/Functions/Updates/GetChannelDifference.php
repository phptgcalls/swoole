<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Updates;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel channelmessagesfilter filter int pts int limit true force
 * @return updates.ChannelDifference
 */

final class GetChannelDifference extends Instance {
	public function request(object $channel,object $filter,int $pts,int $limit,? true $force = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3173d78);
		$flags = 0;
		$flags |= is_null($force) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		$writer->write($filter->read());
		$writer->writeInt($pts);
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