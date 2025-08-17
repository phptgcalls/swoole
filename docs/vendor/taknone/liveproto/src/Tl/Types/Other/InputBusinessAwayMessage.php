<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int shortcut_id businessawaymessageschedule schedule inputbusinessrecipients recipients true offline_only
 * @return InputBusinessAwayMessage
 */

final class InputBusinessAwayMessage extends Instance {
	public function request(int $shortcut_id,object $schedule,object $recipients,? true $offline_only = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x832175e0);
		$flags = 0;
		$flags |= is_null($offline_only) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($shortcut_id);
		$writer->write($schedule->read());
		$writer->write($recipients->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['offline_only'] = true;
		else:
			$result['offline_only'] = false;
		endif;
		$result['shortcut_id'] = $reader->readInt();
		$result['schedule'] = $reader->tgreadObject();
		$result['recipients'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>