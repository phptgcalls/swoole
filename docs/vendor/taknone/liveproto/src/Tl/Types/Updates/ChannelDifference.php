<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Updates;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int pts Vector<Message> new_messages Vector<Update> other_updates Vector<Chat> chats Vector<User> users true final int timeout
 * @return updates.ChannelDifference
 */

final class ChannelDifference extends Instance {
	public function request(int $pts,array $new_messages,array $other_updates,array $chats,array $users,? true $final = null,? int $timeout = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2064674e);
		$flags = 0;
		$flags |= is_null($final) ? 0 : (1 << 0);
		$flags |= is_null($timeout) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeInt($pts);
		if(is_null($timeout) === false):
			$writer->writeInt($timeout);
		endif;
		$writer->tgwriteVector($new_messages,'Message');
		$writer->tgwriteVector($other_updates,'Update');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['final'] = true;
		else:
			$result['final'] = false;
		endif;
		$result['pts'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['timeout'] = $reader->readInt();
		else:
			$result['timeout'] = null;
		endif;
		$result['new_messages'] = $reader->tgreadVector('Message');
		$result['other_updates'] = $reader->tgreadVector('Update');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>