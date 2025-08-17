<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int album_id int offset int limit
 * @return stories.Stories
 */

final class GetAlbumStories extends Instance {
	public function request(object $peer,int $album_id,int $offset,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xac806d61);
		$writer->write($peer->read());
		$writer->writeInt($album_id);
		$writer->writeInt($offset);
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