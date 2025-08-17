<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call
 * @return phone.GroupCallStreamChannels
 */

final class GetGroupCallStreamChannels extends Instance {
	public function request(object $call) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1ab21940);
		$writer->write($call->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>