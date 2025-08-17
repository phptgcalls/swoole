<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call int source
 * @return Updates
 */

final class LeaveGroupCall extends Instance {
	public function request(object $call,int $source) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x500377f9);
		$writer->write($call->read());
		$writer->writeInt($source);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>