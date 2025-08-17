<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id int limit bytes option string offset
 * @return messages.VotesList
 */

final class GetPollVotes extends Instance {
	public function request(object $peer,int $id,int $limit,? string $option = null,? string $offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb86e380e);
		$flags = 0;
		$flags |= is_null($option) ? 0 : (1 << 0);
		$flags |= is_null($offset) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($id);
		if(is_null($option) === false):
			$writer->tgwriteBytes($option);
		endif;
		if(is_null($offset) === false):
			$writer->tgwriteBytes($offset);
		endif;
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