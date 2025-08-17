<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id int topic_id true pinned
 * @return Update
 */

final class UpdateChannelPinnedTopic extends Instance {
	public function request(int $channel_id,int $topic_id,? true $pinned = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x192efbe3);
		$flags = 0;
		$flags |= is_null($pinned) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($channel_id);
		$writer->writeInt($topic_id);
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
		$result['topic_id'] = $reader->readInt();
		return new self($result);
	}
}

?>