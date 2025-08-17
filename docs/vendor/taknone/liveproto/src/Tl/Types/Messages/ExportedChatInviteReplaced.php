<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param exportedchatinvite invite exportedchatinvite new_invite Vector<User> users
 * @return messages.ExportedChatInvite
 */

final class ExportedChatInviteReplaced extends Instance {
	public function request(object $invite,object $new_invite,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x222600ef);
		$writer->write($invite->read());
		$writer->write($new_invite->read());
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['invite'] = $reader->tgreadObject();
		$result['new_invite'] = $reader->tgreadObject();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>