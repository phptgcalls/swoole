<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Updates;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param dialog dialog Vector<Message> messages Vector<Chat> chats Vector<User> users true final int timeout
 * @return updates.ChannelDifference
 */

final class ChannelDifferenceTooLong extends Instance {
	public function request(object $dialog,array $messages,array $chats,array $users,? true $final = null,? int $timeout = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa4bcc6fe);
		$flags = 0;
		$flags |= is_null($final) ? 0 : (1 << 0);
		$flags |= is_null($timeout) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($timeout) === false):
			$writer->writeInt($timeout);
		endif;
		$writer->write($dialog->read());
		$writer->tgwriteVector($messages,'Message');
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
		if($flags & (1 << 1)):
			$result['timeout'] = $reader->readInt();
		else:
			$result['timeout'] = null;
		endif;
		$result['dialog'] = $reader->tgreadObject();
		$result['messages'] = $reader->tgreadVector('Message');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>