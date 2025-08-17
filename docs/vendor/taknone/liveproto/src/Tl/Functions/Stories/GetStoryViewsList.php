<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id string offset int limit true just_contacts true reactions_first true forwards_first string q
 * @return stories.StoryViewsList
 */

final class GetStoryViewsList extends Instance {
	public function request(object $peer,int $id,string $offset,int $limit,? true $just_contacts = null,? true $reactions_first = null,? true $forwards_first = null,? string $q = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7ed23c57);
		$flags = 0;
		$flags |= is_null($just_contacts) ? 0 : (1 << 0);
		$flags |= is_null($reactions_first) ? 0 : (1 << 2);
		$flags |= is_null($forwards_first) ? 0 : (1 << 3);
		$flags |= is_null($q) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($q) === false):
			$writer->tgwriteBytes($q);
		endif;
		$writer->writeInt($id);
		$writer->tgwriteBytes($offset);
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