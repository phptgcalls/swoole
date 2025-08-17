<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer parent_peer
 * @return Vector<DialogPeer>
 */

final class GetDialogUnreadMarks extends Instance {
	public function request(? object $parent_peer = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x21202222);
		$flags = 0;
		$flags |= is_null($parent_peer) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($parent_peer) === false):
			$writer->write($parent_peer->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>