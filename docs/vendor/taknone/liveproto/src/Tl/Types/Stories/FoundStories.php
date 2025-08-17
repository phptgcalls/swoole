<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<FoundStory> stories Vector<Chat> chats Vector<User> users string next_offset
 * @return stories.FoundStories
 */

final class FoundStories extends Instance {
	public function request(int $count,array $stories,array $chats,array $users,? string $next_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe2de7737);
		$flags = 0;
		$flags |= is_null($next_offset) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		$writer->tgwriteVector($stories,'FoundStory');
		if(is_null($next_offset) === false):
			$writer->tgwriteBytes($next_offset);
		endif;
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['count'] = $reader->readInt();
		$result['stories'] = $reader->tgreadVector('FoundStory');
		if($flags & (1 << 0)):
			$result['next_offset'] = $reader->tgreadBytes();
		else:
			$result['next_offset'] = null;
		endif;
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>