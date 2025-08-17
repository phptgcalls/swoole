<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param exportedchatinvite invite long approved_by
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionParticipantJoinByRequest extends Instance {
	public function request(object $invite,int $approved_by) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xafb6144a);
		$writer->write($invite->read());
		$writer->writeLong($approved_by);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['invite'] = $reader->tgreadObject();
		$result['approved_by'] = $reader->readLong();
		return new self($result);
	}
}

?>