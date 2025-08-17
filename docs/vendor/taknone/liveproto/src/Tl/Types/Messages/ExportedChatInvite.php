<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param exportedchatinvite invite Vector<User> users
 * @return messages.ExportedChatInvite
 */

final class ExportedChatInvite extends Instance {
	public function request(object $invite,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1871be50);
		$writer->write($invite->read());
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['invite'] = $reader->tgreadObject();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>