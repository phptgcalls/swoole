<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count string state Vector<PeerStories> peer_stories Vector<Chat> chats Vector<User> users storiesstealthmode stealth_mode true has_more
 * @return stories.AllStories
 */

final class AllStories extends Instance {
	public function request(int $count,string $state,array $peer_stories,array $chats,array $users,object $stealth_mode,? true $has_more = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6efc5e81);
		$flags = 0;
		$flags |= is_null($has_more) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		$writer->tgwriteBytes($state);
		$writer->tgwriteVector($peer_stories,'PeerStories');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		$writer->write($stealth_mode->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['has_more'] = true;
		else:
			$result['has_more'] = false;
		endif;
		$result['count'] = $reader->readInt();
		$result['state'] = $reader->tgreadBytes();
		$result['peer_stories'] = $reader->tgreadVector('PeerStories');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		$result['stealth_mode'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>