<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param dialogpeer peer true unread peer saved_peer_id
 * @return Update
 */

final class UpdateDialogUnreadMark extends Instance {
	public function request(object $peer,? true $unread = null,? object $saved_peer_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb658f23e);
		$flags = 0;
		$flags |= is_null($unread) ? 0 : (1 << 0);
		$flags |= is_null($saved_peer_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($saved_peer_id) === false):
			$writer->write($saved_peer_id->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['unread'] = true;
		else:
			$result['unread'] = false;
		endif;
		$result['peer'] = $reader->tgreadObject();
		if($flags & (1 << 1)):
			$result['saved_peer_id'] = $reader->tgreadObject();
		else:
			$result['saved_peer_id'] = null;
		endif;
		return new self($result);
	}
}

?>