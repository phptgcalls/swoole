<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id int limit true forwards_first reaction reaction string offset
 * @return stories.StoryReactionsList
 */

final class GetStoryReactionsList extends Instance {
	public function request(object $peer,int $id,int $limit,? true $forwards_first = null,? object $reaction = null,? string $offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb9b2881f);
		$flags = 0;
		$flags |= is_null($forwards_first) ? 0 : (1 << 2);
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