<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param forumtopic prev_topic forumtopic new_topic
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionPinTopic extends Instance {
	public function request(? object $prev_topic = null,? object $new_topic = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5d8d353b);
		$flags = 0;
		$flags |= is_null($prev_topic) ? 0 : (1 << 0);
		$flags |= is_null($new_topic) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($prev_topic) === false):
			$writer->write($prev_topic->read());
		endif;
		if(is_null($new_topic) === false):
			$writer->write($new_topic->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['prev_topic'] = $reader->tgreadObject();
		else:
			$result['prev_topic'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['new_topic'] = $reader->tgreadObject();
		else:
			$result['new_topic'] = null;
		endif;
		return new self($result);
	}
}

?>