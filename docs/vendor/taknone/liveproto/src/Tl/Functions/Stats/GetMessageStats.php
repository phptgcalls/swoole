<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stats;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel int msg_id true dark
 * @return stats.MessageStats
 */

final class GetMessageStats extends Instance {
	public function request(object $channel,int $msg_id,? true $dark = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb6e0a3f5);
		$flags = 0;
		$flags |= is_null($dark) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		$writer->writeInt($msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>