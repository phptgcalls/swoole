<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string offset int limit string hashtag mediaarea area inputpeer peer
 * @return stories.FoundStories
 */

final class SearchPosts extends Instance {
	public function request(string $offset,int $limit,? string $hashtag = null,? object $area = null,? object $peer = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd1810907);
		$flags = 0;
		$flags |= is_null($hashtag) ? 0 : (1 << 0);
		$flags |= is_null($area) ? 0 : (1 << 1);
		$flags |= is_null($peer) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($hashtag) === false):
			$writer->tgwriteBytes($hashtag);
		endif;
		if(is_null($area) === false):
			$writer->write($area->read());
		endif;
		if(is_null($peer) === false):
			$writer->write($peer->read());
		endif;
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