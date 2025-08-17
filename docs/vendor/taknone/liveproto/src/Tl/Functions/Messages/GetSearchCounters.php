<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer Vector<MessagesFilter> filters inputpeer saved_peer_id int top_msg_id
 * @return Vector<messages.SearchCounter>
 */

final class GetSearchCounters extends Instance {
	public function request(object $peer,array $filters,? object $saved_peer_id = null,? int $top_msg_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1bbcf300);
		$flags = 0;
		$flags |= is_null($saved_peer_id) ? 0 : (1 << 2);
		$flags |= is_null($top_msg_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($saved_peer_id) === false):
			$writer->write($saved_peer_id->read());
		endif;
		if(is_null($top_msg_id) === false):
			$writer->writeInt($top_msg_id);
		endif;
		$writer->tgwriteVector($filters,'MessagesFilter');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>