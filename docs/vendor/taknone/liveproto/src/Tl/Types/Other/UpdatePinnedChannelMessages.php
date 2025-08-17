<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id Vector<int> messages int pts int pts_count true pinned
 * @return Update
 */

final class UpdatePinnedChannelMessages extends Instance {
	public function request(int $channel_id,array $messages,int $pts,int $pts_count,? true $pinned = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5bb98608);
		$flags = 0;
		$flags |= is_null($pinned) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($channel_id);
		$writer->tgwriteVector($messages,'int');
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['pinned'] = true;
		else:
			$result['pinned'] = false;
		endif;
		$result['channel_id'] = $reader->readLong();
		$result['messages'] = $reader->tgreadVector('int');
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		return new self($result);
	}
}

?>