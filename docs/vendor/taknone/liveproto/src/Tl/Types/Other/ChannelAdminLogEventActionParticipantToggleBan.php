<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param channelparticipant prev_participant channelparticipant new_participant
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionParticipantToggleBan extends Instance {
	public function request(object $prev_participant,object $new_participant) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe6d83d7e);
		$writer->write($prev_participant->read());
		$writer->write($new_participant->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prev_participant'] = $reader->tgreadObject();
		$result['new_participant'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>