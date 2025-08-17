<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel int top_msg_id
 * @return messages.AffectedHistory
 */

final class DeleteTopicHistory extends Instance {
	public function request(object $channel,int $top_msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x34435f2d);
		$writer->write($channel->read());
		$writer->writeInt($top_msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>