<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param exportedchatinvite invite true via_chatlist
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionParticipantJoinByInvite extends Instance {
	public function request(object $invite,? true $via_chatlist = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfe9fc158);
		$flags = 0;
		$flags |= is_null($via_chatlist) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($invite->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['via_chatlist'] = true;
		else:
			$result['via_chatlist'] = false;
		endif;
		$result['invite'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>