<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int prev_value int new_value
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionToggleSlowMode extends Instance {
	public function request(int $prev_value,int $new_value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x53909779);
		$writer->writeInt($prev_value);
		$writer->writeInt($new_value);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prev_value'] = $reader->readInt();
		$result['new_value'] = $reader->readInt();
		return new self($result);
	}
}

?>