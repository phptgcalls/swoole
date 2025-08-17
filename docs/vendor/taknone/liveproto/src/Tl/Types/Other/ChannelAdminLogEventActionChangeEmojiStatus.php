<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param emojistatus prev_value emojistatus new_value
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionChangeEmojiStatus extends Instance {
	public function request(object $prev_value,object $new_value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3ea9feb1);
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