<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param chatbannedrights prev_banned_rights chatbannedrights new_banned_rights
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionDefaultBannedRights extends Instance {
	public function request(object $prev_banned_rights,object $new_banned_rights) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2df5fc0a);
		$writer->write($prev_banned_rights->read());
		$writer->write($new_banned_rights->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prev_banned_rights'] = $reader->tgreadObject();
		$result['new_banned_rights'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>