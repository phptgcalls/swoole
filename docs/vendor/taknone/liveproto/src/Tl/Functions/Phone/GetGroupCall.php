<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call int limit
 * @return phone.GroupCall
 */

final class GetGroupCall extends Instance {
	public function request(object $call,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x41845db);
		$writer->write($call->read());
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>