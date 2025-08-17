<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param forumtopic topic
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionDeleteTopic extends Instance {
	public function request(object $topic) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xae168909);
		$writer->write($topic->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['topic'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>