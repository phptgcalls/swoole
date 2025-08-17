<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id int date true blocked true blocked_my_stories_from reaction reaction
 * @return StoryView
 */

final class StoryView extends Instance {
	public function request(int $user_id,int $date,? true $blocked = null,? true $blocked_my_stories_from = null,? object $reaction = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb0bdeac5);
		$flags = 0;
		$flags |= is_null($blocked) ? 0 : (1 << 0);
		$flags |= is_null($blocked_my_stories_from) ? 0 : (1 << 1);
		$flags |= is_null($reaction) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeLong($user_id);
		$writer->writeInt($date);
		if(is_null($reaction) === false):
			$writer->write($reaction->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['blocked'] = true;
		else:
			$result['blocked'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['blocked_my_stories_from'] = true;
		else:
			$result['blocked_my_stories_from'] = false;
		endif;
		$result['user_id'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		if($flags & (1 << 2)):
			$result['reaction'] = $reader->tgreadObject();
		else:
			$result['reaction'] = null;
		endif;
		return new self($result);
	}
}

?>