<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<ExportedChatInvite> invites Vector<User> users
 * @return messages.ExportedChatInvites
 */

final class ExportedChatInvites extends Instance {
	public function request(int $count,array $invites,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbdc62dcc);
		$writer->writeInt($count);
		$writer->tgwriteVector($invites,'ExportedChatInvite');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['invites'] = $reader->tgreadVector('ExportedChatInvite');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>