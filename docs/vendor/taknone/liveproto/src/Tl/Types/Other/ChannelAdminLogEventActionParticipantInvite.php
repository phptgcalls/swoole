<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param channelparticipant participant
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionParticipantInvite extends Instance {
	public function request(object $participant) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe31c34d8);
		$writer->write($participant->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['participant'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>