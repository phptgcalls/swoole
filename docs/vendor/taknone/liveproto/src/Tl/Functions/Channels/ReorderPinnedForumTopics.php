<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel Vector<int> order true force
 * @return Updates
 */

final class ReorderPinnedForumTopics extends Instance {
	public function request(object $channel,array $order,? true $force = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2950a18f);
		$flags = 0;
		$flags |= is_null($force) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		$writer->tgwriteVector($order,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>