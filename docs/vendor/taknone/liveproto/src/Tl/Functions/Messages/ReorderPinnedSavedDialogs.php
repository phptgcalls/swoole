<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputDialogPeer> order true force
 * @return Bool
 */

final class ReorderPinnedSavedDialogs extends Instance {
	public function request(array $order,? true $force = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8b716587);
		$flags = 0;
		$flags |= is_null($force) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteVector($order,'InputDialogPeer');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>