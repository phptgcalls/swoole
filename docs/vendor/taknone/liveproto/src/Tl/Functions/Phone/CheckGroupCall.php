<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call Vector<int> sources
 * @return Vector<int>
 */

final class CheckGroupCall extends Instance {
	public function request(object $call,array $sources) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb59cf977);
		$writer->write($call->read());
		$writer->tgwriteVector($sources,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>