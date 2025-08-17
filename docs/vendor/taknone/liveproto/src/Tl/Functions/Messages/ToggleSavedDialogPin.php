<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputdialogpeer peer true pinned
 * @return Bool
 */

final class ToggleSavedDialogPin extends Instance {
	public function request(object $peer,? true $pinned = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xac81bbde);
		$flags = 0;
		$flags |= is_null($pinned) ? 0 : (1 << 0);
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