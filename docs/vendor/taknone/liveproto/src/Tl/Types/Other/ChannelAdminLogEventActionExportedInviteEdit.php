<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param exportedchatinvite prev_invite exportedchatinvite new_invite
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionExportedInviteEdit extends Instance {
	public function request(object $prev_invite,object $new_invite) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe90ebb59);
		$writer->write($prev_invite->read());
		$writer->write($new_invite->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prev_invite'] = $reader->tgreadObject();
		$result['new_invite'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>