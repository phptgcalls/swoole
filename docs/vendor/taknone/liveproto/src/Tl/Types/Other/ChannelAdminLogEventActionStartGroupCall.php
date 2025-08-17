<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionStartGroupCall extends Instance {
	public function request(object $call) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x23209745);
		$writer->write($call->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['call'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>