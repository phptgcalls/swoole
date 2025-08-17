<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int top_msg_id inputpeer saved_peer_id
 * @return messages.AffectedHistory
 */

final class UnpinAllMessages extends Instance {
	public function request(object $peer,? int $top_msg_id = null,? object $saved_peer_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x62dd747);
		$flags = 0;
		$flags |= is_null($top_msg_id) ? 0 : (1 << 0);
		$flags |= is_null($saved_peer_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($top_msg_id) === false):
			$writer->writeInt($top_msg_id);
		endif;
		if(is_null($saved_peer_id) === false):
			$writer->write($saved_peer_id->read());
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