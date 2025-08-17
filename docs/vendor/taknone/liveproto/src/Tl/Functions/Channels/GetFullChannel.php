<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel
 * @return messages.ChatFull
 */

final class GetFullChannel extends Instance {
	public function request(object $channel) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8736a09);
		$writer->write($channel->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>