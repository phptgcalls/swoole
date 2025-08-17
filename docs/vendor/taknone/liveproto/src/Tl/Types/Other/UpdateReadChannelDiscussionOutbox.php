<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id int top_msg_id int read_max_id
 * @return Update
 */

final class UpdateReadChannelDiscussionOutbox extends Instance {
	public function request(int $channel_id,int $top_msg_id,int $read_max_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x695c9e7c);
		$writer->writeLong($channel_id);
		$writer->writeInt($top_msg_id);
		$writer->writeInt($read_max_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel_id'] = $reader->readLong();
		$result['top_msg_id'] = $reader->readInt();
		$result['read_max_id'] = $reader->readInt();
		return new self($result);
	}
}

?>