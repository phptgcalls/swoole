<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer chatbannedrights banned_rights
 * @return Updates
 */

final class EditChatDefaultBannedRights extends Instance {
	public function request(object $peer,object $banned_rights) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa5866b41);
		$writer->write($peer->read());
		$writer->write($banned_rights->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>