<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int shortcut_id inputbusinessrecipients recipients int no_activity_days
 * @return InputBusinessGreetingMessage
 */

final class InputBusinessGreetingMessage extends Instance {
	public function request(int $shortcut_id,object $recipients,int $no_activity_days) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x194cb3b);
		$writer->writeInt($shortcut_id);
		$writer->write($recipients->read());
		$writer->writeInt($no_activity_days);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['shortcut_id'] = $reader->readInt();
		$result['recipients'] = $reader->tgreadObject();
		$result['no_activity_days'] = $reader->readInt();
		return new self($result);
	}
}

?>