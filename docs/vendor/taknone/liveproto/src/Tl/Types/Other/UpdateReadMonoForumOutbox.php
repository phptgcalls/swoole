<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id peer saved_peer_id int read_max_id
 * @return Update
 */

final class UpdateReadMonoForumOutbox extends Instance {
	public function request(int $channel_id,object $saved_peer_id,int $read_max_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa4a79376);
		$writer->writeLong($channel_id);
		$writer->write($saved_peer_id->read());
		$writer->writeInt($read_max_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel_id'] = $reader->readLong();
		$result['saved_peer_id'] = $reader->tgreadObject();
		$result['read_max_id'] = $reader->readInt();
		return new self($result);
	}
}

?>