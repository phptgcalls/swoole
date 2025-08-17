<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call bool subscribed
 * @return Updates
 */

final class ToggleGroupCallStartSubscription extends Instance {
	public function request(object $call,bool $subscribed) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x219c34e6);
		$writer->write($call->read());
		$writer->tgwriteBool($subscribed);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>