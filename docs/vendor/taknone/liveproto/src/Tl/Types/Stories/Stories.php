<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<StoryItem> stories Vector<Chat> chats Vector<User> users Vector<int> pinned_to_top
 * @return stories.Stories
 */

final class Stories extends Instance {
	public function request(int $count,array $stories,array $chats,array $users,? array $pinned_to_top = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x63c3dd0a);
		$flags = 0;
		$flags |= is_null($pinned_to_top) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		$writer->tgwriteVector($stories,'StoryItem');
		if(is_null($pinned_to_top) === false):
			$writer->tgwriteVector($pinned_to_top,'int');
		endif;
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['count'] = $reader->readInt();
		$result['stories'] = $reader->tgreadVector('StoryItem');
		if($flags & (1 << 0)):
			$result['pinned_to_top'] = $reader->tgreadVector('int');
		else:
			$result['pinned_to_top'] = null;
		endif;
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>