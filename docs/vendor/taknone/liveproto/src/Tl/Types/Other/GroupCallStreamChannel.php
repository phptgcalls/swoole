<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int channel int scale long last_timestamp_ms
 * @return GroupCallStreamChannel
 */

final class GroupCallStreamChannel extends Instance {
	public function request(int $channel,int $scale,int $last_timestamp_ms) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x80eb48af);
		$writer->writeInt($channel);
		$writer->writeInt($scale);
		$writer->writeLong($last_timestamp_ms);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel'] = $reader->readInt();
		$result['scale'] = $reader->readInt();
		$result['last_timestamp_ms'] = $reader->readLong();
		return new self($result);
	}
}

?>