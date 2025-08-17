<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<ForumTopic> topics Vector<Message> messages Vector<Chat> chats Vector<User> users int pts true order_by_create_date
 * @return messages.ForumTopics
 */

final class ForumTopics extends Instance {
	public function request(int $count,array $topics,array $messages,array $chats,array $users,int $pts,? true $order_by_create_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x367617d3);
		$flags = 0;
		$flags |= is_null($order_by_create_date) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		$writer->tgwriteVector($topics,'ForumTopic');
		$writer->tgwriteVector($messages,'Message');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		$writer->writeInt($pts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['order_by_create_date'] = true;
		else:
			$result['order_by_create_date'] = false;
		endif;
		$result['count'] = $reader->readInt();
		$result['topics'] = $reader->tgreadVector('ForumTopic');
		$result['messages'] = $reader->tgreadVector('Message');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		$result['pts'] = $reader->readInt();
		return new self($result);
	}
}

?>