<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id int limit reaction reaction string offset
 * @return messages.MessageReactionsList
 */

final class GetMessageReactionsList extends Instance {
	public function request(object $peer,int $id,int $limit,? object $reaction = null,? string $offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x461b3f48);
		$flags = 0;
		$flags |= is_null($reaction) ? 0 : (1 << 0);
		$flags |= is_null($offset) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($id);
		if(is_null($reaction) === false):
			$writer->write($reaction->read());
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