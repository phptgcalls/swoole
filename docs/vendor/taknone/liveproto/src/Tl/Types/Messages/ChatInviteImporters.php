<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<ChatInviteImporter> importers Vector<User> users
 * @return messages.ChatInviteImporters
 */

final class ChatInviteImporters extends Instance {
	public function request(int $count,array $importers,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x81b6b00a);
		$writer->writeInt($count);
		$writer->tgwriteVector($importers,'ChatInviteImporter');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['importers'] = $reader->tgreadVector('ChatInviteImporter');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>