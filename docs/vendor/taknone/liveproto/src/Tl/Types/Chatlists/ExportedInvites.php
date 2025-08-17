<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Chatlists;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<ExportedChatlistInvite> invites Vector<Chat> chats Vector<User> users
 * @return chatlists.ExportedInvites
 */

final class ExportedInvites extends Instance {
	public function request(array $invites,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x10ab6dc7);
		$writer->tgwriteVector($invites,'ExportedChatlistInvite');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['invites'] = $reader->tgreadVector('ExportedChatlistInvite');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>