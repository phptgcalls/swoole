<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count int views_count int forwards_count int reactions_count Vector<StoryView> views Vector<Chat> chats Vector<User> users string next_offset
 * @return stories.StoryViewsList
 */

final class StoryViewsList extends Instance {
	public function request(int $count,int $views_count,int $forwards_count,int $reactions_count,array $views,array $chats,array $users,? string $next_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x59d78fc5);
		$flags = 0;
		$flags |= is_null($next_offset) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		$writer->writeInt($views_count);
		$writer->writeInt($forwards_count);
		$writer->writeInt($reactions_count);
		$writer->tgwriteVector($views,'StoryView');
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
		$result['views_count'] = $reader->readInt();
		$result['forwards_count'] = $reader->readInt();
		$result['reactions_count'] = $reader->readInt();
		$result['views'] = $reader->tgreadVector('StoryView');
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