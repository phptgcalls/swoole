<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id long access_hash
 * @return InputChannel
 */

final class InputChannel extends Instance {
	public function request(int $channel_id,int $access_hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf35aec28);
		$writer->writeLong($channel_id);
		$writer->writeLong($access_hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel_id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		return new self($result);
	}
}

?>