<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id int available_min_id
 * @return Update
 */

final class UpdateChannelAvailableMessages extends Instance {
	public function request(int $channel_id,int $available_min_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb23fc698);
		$writer->writeLong($channel_id);
		$writer->writeInt($available_min_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel_id'] = $reader->readLong();
		$result['available_min_id'] = $reader->readInt();
		return new self($result);
	}
}

?>