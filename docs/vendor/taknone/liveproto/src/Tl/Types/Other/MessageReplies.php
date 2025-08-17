<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int replies int replies_pts true comments Vector<Peer> recent_repliers long channel_id int max_id int read_max_id
 * @return MessageReplies
 */

final class MessageReplies extends Instance {
	public function request(int $replies,int $replies_pts,? true $comments = null,? array $recent_repliers = null,? int $channel_id = null,? int $max_id = null,? int $read_max_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x83d60fc2);
		$flags = 0;
		$flags |= is_null($comments) ? 0 : (1 << 0);
		$flags |= is_null($recent_repliers) ? 0 : (1 << 1);
		$flags |= is_null($channel_id) ? 0 : (1 << 0);
		$flags |= is_null($max_id) ? 0 : (1 << 2);
		$flags |= is_null($read_max_id) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->writeInt($replies);
		$writer->writeInt($replies_pts);
		if(is_null($recent_repliers) === false):
			$writer->tgwriteVector($recent_repliers,'Peer');
		endif;
		if(is_null($channel_id) === false):
			$writer->writeLong($channel_id);
		endif;
		if(is_null($max_id) === false):
			$writer->writeInt($max_id);
		endif;
		if(is_null($read_max_id) === false):
			$writer->writeInt($read_max_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['comments'] = true;
		else:
			$result['comments'] = false;
		endif;
		$result['replies'] = $reader->readInt();
		$result['replies_pts'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['recent_repliers'] = $reader->tgreadVector('Peer');
		else:
			$result['recent_repliers'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['channel_id'] = $reader->readLong();
		else:
			$result['channel_id'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['max_id'] = $reader->readInt();
		else:
			$result['max_id'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['read_max_id'] = $reader->readInt();
		else:
			$result['read_max_id'] = null;
		endif;
		return new self($result);
	}
}

?>