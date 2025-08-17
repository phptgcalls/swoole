<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<StoryViews> views Vector<User> users
 * @return stories.StoryViews
 */

final class StoryViews extends Instance {
	public function request(array $views,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xde9eed1d);
		$writer->tgwriteVector($views,'StoryViews');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['views'] = $reader->tgreadVector('StoryViews');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>