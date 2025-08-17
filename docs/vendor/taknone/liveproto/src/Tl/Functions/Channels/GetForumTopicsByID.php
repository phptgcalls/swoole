<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel Vector<int> topics
 * @return messages.ForumTopics
 */

final class GetForumTopicsByID extends Instance {
	public function request(object $channel,array $topics) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb0831eb9);
		$writer->write($channel->read());
		$writer->tgwriteVector($topics,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>