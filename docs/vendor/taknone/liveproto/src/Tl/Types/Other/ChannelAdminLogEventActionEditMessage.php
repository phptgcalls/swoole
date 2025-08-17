<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param message prev_message message new_message
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionEditMessage extends Instance {
	public function request(object $prev_message,object $new_message) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x709b2405);
		$writer->write($prev_message->read());
		$writer->write($new_message->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prev_message'] = $reader->tgreadObject();
		$result['new_message'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>