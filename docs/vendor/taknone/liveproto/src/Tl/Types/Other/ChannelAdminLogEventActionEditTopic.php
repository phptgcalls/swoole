<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param forumtopic prev_topic forumtopic new_topic
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionEditTopic extends Instance {
	public function request(object $prev_topic,object $new_topic) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf06fe208);
		$writer->write($prev_topic->read());
		$writer->write($new_topic->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prev_topic'] = $reader->tgreadObject();
		$result['new_topic'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>