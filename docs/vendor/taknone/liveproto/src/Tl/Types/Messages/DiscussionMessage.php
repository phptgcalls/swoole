<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Message> messages int unread_count Vector<Chat> chats Vector<User> users int max_id int read_inbox_max_id int read_outbox_max_id
 * @return messages.DiscussionMessage
 */

final class DiscussionMessage extends Instance {
	public function request(array $messages,int $unread_count,array $chats,array $users,? int $max_id = null,? int $read_inbox_max_id = null,? int $read_outbox_max_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa6341782);
		$flags = 0;
		$flags |= is_null($max_id) ? 0 : (1 << 0);
		$flags |= is_null($read_inbox_max_id) ? 0 : (1 << 1);
		$flags |= is_null($read_outbox_max_id) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteVector($messages,'Message');
		if(is_null($max_id) === false):
			$writer->writeInt($max_id);
		endif;
		if(is_null($read_inbox_max_id) === false):
			$writer->writeInt($read_inbox_max_id);
		endif;
		if(is_null($read_outbox_max_id) === false):
			$writer->writeInt($read_outbox_max_id);
		endif;
		$writer->writeInt($unread_count);
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['messages'] = $reader->tgreadVector('Message');
		if($flags & (1 << 0)):
			$result['max_id'] = $reader->readInt();
		else:
			$result['max_id'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['read_inbox_max_id'] = $reader->readInt();
		else:
			$result['read_inbox_max_id'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['read_outbox_max_id'] = $reader->readInt();
		else:
			$result['read_outbox_max_id'] = null;
		endif;
		$result['unread_count'] = $reader->readInt();
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>