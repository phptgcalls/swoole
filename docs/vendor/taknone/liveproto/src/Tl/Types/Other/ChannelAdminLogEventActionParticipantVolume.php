<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param groupcallparticipant participant
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionParticipantVolume extends Instance {
	public function request(object $participant) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3e7f6847);
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