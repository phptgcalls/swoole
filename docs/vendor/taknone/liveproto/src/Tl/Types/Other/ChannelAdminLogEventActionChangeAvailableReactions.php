<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param chatreactions prev_value chatreactions new_value
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionChangeAvailableReactions extends Instance {
	public function request(object $prev_value,object $new_value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbe4e0ef8);
		$writer->write($prev_value->read());
		$writer->write($new_value->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prev_value'] = $reader->tgreadObject();
		$result['new_value'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>