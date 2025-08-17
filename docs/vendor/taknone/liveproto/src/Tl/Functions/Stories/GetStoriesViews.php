<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer Vector<int> id
 * @return stories.StoryViews
 */

final class GetStoriesViews extends Instance {
	public function request(object $peer,array $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x28e16cc8);
		$writer->write($peer->read());
		$writer->tgwriteVector($id,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>