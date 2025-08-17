<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<ChatAdminWithInvites> admins Vector<User> users
 * @return messages.ChatAdminsWithInvites
 */

final class ChatAdminsWithInvites extends Instance {
	public function request(array $admins,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb69b72d7);
		$writer->tgwriteVector($admins,'ChatAdminWithInvites');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['admins'] = $reader->tgreadVector('ChatAdminWithInvites');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>