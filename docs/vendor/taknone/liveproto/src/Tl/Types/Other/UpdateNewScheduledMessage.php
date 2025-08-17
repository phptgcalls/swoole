<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param message message
 * @return Update
 */

final class UpdateNewScheduledMessage extends Instance {
	public function request(object $message) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x39a51dfb);
		$writer->write($message->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['message'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>