<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputPeer> ids inputpeer parent_peer
 * @return messages.SavedDialogs
 */

final class GetSavedDialogsByID extends Instance {
	public function request(array $ids,? object $parent_peer = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6f6f9c96);
		$flags = 0;
		$flags |= is_null($parent_peer) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($parent_peer) === false):
			$writer->write($parent_peer->read());
		endif;
		$writer->tgwriteVector($ids,'InputPeer');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>