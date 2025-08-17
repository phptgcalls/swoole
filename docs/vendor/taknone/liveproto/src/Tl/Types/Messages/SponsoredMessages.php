<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<SponsoredMessage> messages Vector<Chat> chats Vector<User> users int posts_between int start_delay int between_delay
 * @return messages.SponsoredMessages
 */

final class SponsoredMessages extends Instance {
	public function request(array $messages,array $chats,array $users,? int $posts_between = null,? int $start_delay = null,? int $between_delay = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xffda656d);
		$flags = 0;
		$flags |= is_null($posts_between) ? 0 : (1 << 0);
		$flags |= is_null($start_delay) ? 0 : (1 << 1);
		$flags |= is_null($between_delay) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($posts_between) === false):
			$writer->writeInt($posts_between);
		endif;
		if(is_null($start_delay) === false):
			$writer->writeInt($start_delay);
		endif;
		if(is_null($between_delay) === false):
			$writer->writeInt($between_delay);
		endif;
		$writer->tgwriteVector($messages,'SponsoredMessage');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['posts_between'] = $reader->readInt();
		else:
			$result['posts_between'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['start_delay'] = $reader->readInt();
		else:
			$result['start_delay'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['between_delay'] = $reader->readInt();
		else:
			$result['between_delay'] = null;
		endif;
		$result['messages'] = $reader->tgreadVector('SponsoredMessage');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>