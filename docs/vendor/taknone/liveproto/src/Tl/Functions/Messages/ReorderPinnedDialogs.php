<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int folder_id Vector<InputDialogPeer> order true force
 * @return Bool
 */

final class ReorderPinnedDialogs extends Instance {
	public function request(int $folder_id,array $order,? true $force = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3b1adf37);
		$flags = 0;
		$flags |= is_null($force) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($folder_id);
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