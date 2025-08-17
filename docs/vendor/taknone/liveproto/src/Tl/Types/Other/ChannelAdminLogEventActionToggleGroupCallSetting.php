<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bool join_muted
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionToggleGroupCallSetting extends Instance {
	public function request(bool $join_muted) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x56d6a247);
		$writer->tgwriteBool($join_muted);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['join_muted'] = $reader->tgreadBool();
		return new self($result);
	}
}

?>