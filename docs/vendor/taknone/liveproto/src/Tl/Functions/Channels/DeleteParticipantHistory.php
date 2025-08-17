<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel inputpeer participant
 * @return messages.AffectedHistory
 */

final class DeleteParticipantHistory extends Instance {
	public function request(object $channel,object $participant) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x367544db);
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