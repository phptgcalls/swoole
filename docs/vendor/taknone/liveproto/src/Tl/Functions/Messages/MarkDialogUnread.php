<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputdialogpeer peer true unread inputpeer parent_peer
 * @return Bool
 */

final class MarkDialogUnread extends Instance {
	public function request(object $peer,? true $unread = null,? object $parent_peer = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8c5006f8);
		$flags = 0;
		$flags |= is_null($unread) ? 0 : (1 << 0);
		$flags |= is_null($parent_peer) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($parent_peer) === false):
			$writer->write($parent_peer->read());
		endif;
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