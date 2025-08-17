<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer messagesfilter filter int offset_id int limit inputpeer saved_peer_id
 * @return messages.SearchResultsPositions
 */

final class GetSearchResultsPositions extends Instance {
	public function request(object $peer,object $filter,int $offset_id,int $limit,? object $saved_peer_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9c7f2f10);
		$flags = 0;
		$flags |= is_null($saved_peer_id) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($saved_peer_id) === false):
			$writer->write($saved_peer_id->read());
		endif;
		$writer->write($filter->read());
		$writer->writeInt($offset_id);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>