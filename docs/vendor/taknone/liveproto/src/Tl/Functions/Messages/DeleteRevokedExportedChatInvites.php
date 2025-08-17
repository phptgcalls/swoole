<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputuser admin_id
 * @return Bool
 */

final class DeleteRevokedExportedChatInvites extends Instance {
	public function request(object $peer,object $admin_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x56987bd5);
		$writer->write($peer->read());
		$writer->write($admin_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>