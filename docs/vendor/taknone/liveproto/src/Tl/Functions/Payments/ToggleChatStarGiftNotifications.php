<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer true enabled
 * @return Bool
 */

final class ToggleChatStarGiftNotifications extends Instance {
	public function request(object $peer,? true $enabled = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x60eaefa1);
		$flags = 0;
		$flags |= is_null($enabled) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>