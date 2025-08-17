<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel emojistatus emoji_status
 * @return Updates
 */

final class UpdateEmojiStatus extends Instance {
	public function request(object $channel,object $emoji_status) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf0d3e6a8);
		$writer->write($channel->read());
		$writer->write($emoji_status->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>