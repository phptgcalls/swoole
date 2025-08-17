<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call int schedule_date
 * @return MessageAction
 */

final class MessageActionGroupCallScheduled extends Instance {
	public function request(object $call,int $schedule_date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb3a07661);
		$writer->write($call->read());
		$writer->writeInt($schedule_date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['call'] = $reader->tgreadObject();
		$result['schedule_date'] = $reader->readInt();
		return new self($result);
	}
}

?>