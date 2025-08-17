<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param exportedchatinvite invite
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionExportedInviteRevoke extends Instance {
	public function request(object $invite) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x410a134e);
		$writer->write($invite->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['invite'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>