<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<MessagePeerVote> votes Vector<Chat> chats Vector<User> users string next_offset
 * @return messages.VotesList
 */

final class VotesList extends Instance {
	public function request(int $count,array $votes,array $chats,array $users,? string $next_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4899484e);
		$flags = 0;
		$flags |= is_null($next_offset) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		$writer->tgwriteVector($votes,'MessagePeerVote');
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
		$result['votes'] = $reader->tgreadVector('MessagePeerVote');
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