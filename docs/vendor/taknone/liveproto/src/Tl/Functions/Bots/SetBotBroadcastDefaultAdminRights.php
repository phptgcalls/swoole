<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param chatadminrights admin_rights
 * @return Bool
 */

final class SetBotBroadcastDefaultAdminRights extends Instance {
	public function request(object $admin_rights) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x788464e1);
		$writer->write($admin_rights->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>