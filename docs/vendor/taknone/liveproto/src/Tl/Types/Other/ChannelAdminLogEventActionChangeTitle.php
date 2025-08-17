<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string prev_value string new_value
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionChangeTitle extends Instance {
	public function request(string $prev_value,string $new_value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe6dfb825);
		$writer->tgwriteBytes($prev_value);
		$writer->tgwriteBytes($new_value);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prev_value'] = $reader->tgreadBytes();
		$result['new_value'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>