<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel inputpeer participant
 * @return channels.ChannelParticipant
 */

final class GetParticipant extends Instance {
	public function request(object $channel,object $participant) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa0ab6cc6);
		$writer->write($channel->read());
		$writer->write($participant->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>