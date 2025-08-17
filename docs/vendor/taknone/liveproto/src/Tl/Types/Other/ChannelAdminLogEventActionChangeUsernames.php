<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<string> prev_value Vector<string> new_value
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionChangeUsernames extends Instance {
	public function request(array $prev_value,array $new_value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf04fb3a9);
		$writer->tgwriteVector($prev_value,'string');
		$writer->tgwriteVector($new_value,'string');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prev_value'] = $reader->tgreadVector('string');
		$result['new_value'] = $reader->tgreadVector('string');
		return new self($result);
	}
}

?>