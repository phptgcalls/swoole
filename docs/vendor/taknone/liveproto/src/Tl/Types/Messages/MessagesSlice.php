<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<Message> messages Vector<Chat> chats Vector<User> users true inexact int next_rate int offset_id_offset searchpostsflood search_flood
 * @return messages.Messages
 */

final class MessagesSlice extends Instance {
	public function request(int $count,array $messages,array $chats,array $users,? true $inexact = null,? int $next_rate = null,? int $offset_id_offset = null,? object $search_flood = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x762b263d);
		$flags = 0;
		$flags |= is_null($inexact) ? 0 : (1 << 1);
		$flags |= is_null($next_rate) ? 0 : (1 << 0);
		$flags |= is_null($offset_id_offset) ? 0 : (1 << 2);
		$flags |= is_null($search_flood) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		if(is_null($next_rate) === false):
			$writer->writeInt($next_rate);
		endif;
		if(is_null($offset_id_offset) === false):
			$writer->writeInt($offset_id_offset);
		endif;
		if(is_null($search_flood) === false):
			$writer->write($search_flood->read());
		endif;
		$writer->tgwriteVector($messages,'Message');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['inexact'] = true;
		else:
			$result['inexact'] = false;
		endif;
		$result['count'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['next_rate'] = $reader->readInt();
		else:
			$result['next_rate'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['offset_id_offset'] = $reader->readInt();
		else:
			$result['offset_id_offset'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['search_flood'] = $reader->tgreadObject();
		else:
			$result['search_flood'] = null;
		endif;
		$result['messages'] = $reader->tgreadVector('Message');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>