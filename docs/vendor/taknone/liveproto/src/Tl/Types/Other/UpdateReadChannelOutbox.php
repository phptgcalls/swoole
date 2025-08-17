<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id int max_id
 * @return Update
 */

final class UpdateReadChannelOutbox extends Instance {
	public function request(int $channel_id,int $max_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb75f99a9);
		$writer->writeLong($channel_id);
		$writer->writeInt($max_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel_id'] = $reader->readLong();
		$result['max_id'] = $reader->readInt();
		return new self($result);
	}
}

?>