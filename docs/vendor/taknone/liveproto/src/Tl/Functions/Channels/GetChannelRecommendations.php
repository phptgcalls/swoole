<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel
 * @return messages.Chats
 */

final class GetChannelRecommendations extends Instance {
	public function request(? object $channel = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x25a71742);
		$flags = 0;
		$flags |= is_null($channel) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($channel) === false):
			$writer->write($channel->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>