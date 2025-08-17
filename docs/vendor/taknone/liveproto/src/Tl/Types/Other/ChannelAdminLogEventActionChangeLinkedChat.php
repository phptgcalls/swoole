<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long prev_value long new_value
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionChangeLinkedChat extends Instance {
	public function request(int $prev_value,int $new_value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x50c7ac8);
		$writer->writeLong($prev_value);
		$writer->writeLong($new_value);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prev_value'] = $reader->readLong();
		$result['new_value'] = $reader->readLong();
		return new self($result);
	}
}

?>