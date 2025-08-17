<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel Vector<InputMessage> id
 * @return messages.Messages
 */

final class GetMessages extends Instance {
	public function request(object $channel,array $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xad8c9a23);
		$writer->write($channel->read());
		$writer->tgwriteVector($id,'InputMessage');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>