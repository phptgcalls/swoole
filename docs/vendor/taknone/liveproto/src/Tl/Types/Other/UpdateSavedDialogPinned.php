<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param dialogpeer peer true pinned
 * @return Update
 */

final class UpdateSavedDialogPinned extends Instance {
	public function request(object $peer,? true $pinned = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xaeaf9e74);
		$flags = 0;
		$flags |= is_null($pinned) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['pinned'] = true;
		else:
			$result['pinned'] = false;
		endif;
		$result['peer'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>