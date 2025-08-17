<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int pts int count Vector<Message> messages Vector<ForumTopic> topics Vector<Chat> chats Vector<User> users true inexact int offset_id_offset
 * @return messages.Messages
 */

final class ChannelMessages extends Instance {
	public function request(int $pts,int $count,array $messages,array $topics,array $chats,array $users,? true $inexact = null,? int $offset_id_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc776ba4e);
		$flags = 0;
		$flags |= is_null($inexact) ? 0 : (1 << 1);
		$flags |= is_null($offset_id_offset) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeInt($pts);
		$writer->writeInt($count);
		if(is_null($offset_id_offset) === false):
			$writer->writeInt($offset_id_offset);
		endif;
		$writer->tgwriteVector($messages,'Message');
		$writer->tgwriteVector($topics,'ForumTopic');
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
		$result['pts'] = $reader->readInt();
		$result['count'] = $reader->readInt();
		if($flags & (1 << 2)):
			$result['offset_id_offset'] = $reader->readInt();
		else:
			$result['offset_id_offset'] = null;
		endif;
		$result['messages'] = $reader->tgreadVector('Message');
		$result['topics'] = $reader->tgreadVector('ForumTopic');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>