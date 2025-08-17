<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id
 * @return Peer
 */

final class PeerChannel extends Instance {
	public function request(int $channel_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa2a5371e);
		$writer->writeLong($channel_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel_id'] = $reader->readLong();
		return new self($result);
	}
}

?>