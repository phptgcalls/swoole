<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputAppEvent> events
 * @return Bool
 */

final class SaveAppLog extends Instance {
	public function request(array $events) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6f02f748);
		$writer->tgwriteVector($events,'InputAppEvent');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>