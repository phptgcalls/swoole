<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<MessagePeerReaction> reactions Vector<Chat> chats Vector<User> users string next_offset
 * @return messages.MessageReactionsList
 */

final class MessageReactionsList extends Instance {
	public function request(int $count,array $reactions,array $chats,array $users,? string $next_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x31bd492d);
		$flags = 0;
		$flags |= is_null($next_offset) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		$writer->tgwriteVector($reactions,'MessagePeerReaction');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		if(is_null($next_offset) === false):
			$writer->tgwriteBytes($next_offset);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['count'] = $reader->readInt();
		$result['reactions'] = $reader->tgreadVector('MessagePeerReaction');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		if($flags & (1 << 0)):
			$result['next_offset'] = $reader->tgreadBytes();
		else:
			$result['next_offset'] = null;
		endif;
		return new self($result);
	}
}

?>