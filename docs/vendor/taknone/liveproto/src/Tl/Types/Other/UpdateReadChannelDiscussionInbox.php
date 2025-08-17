<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id int top_msg_id int read_max_id long broadcast_id int broadcast_post
 * @return Update
 */

final class UpdateReadChannelDiscussionInbox extends Instance {
	public function request(int $channel_id,int $top_msg_id,int $read_max_id,? int $broadcast_id = null,? int $broadcast_post = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd6b19546);
		$flags = 0;
		$flags |= is_null($broadcast_id) ? 0 : (1 << 0);
		$flags |= is_null($broadcast_post) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($channel_id);
		$writer->writeInt($top_msg_id);
		$writer->writeInt($read_max_id);
		if(is_null($broadcast_id) === false):
			$writer->writeLong($broadcast_id);
		endif;
		if(is_null($broadcast_post) === false):
			$writer->writeInt($broadcast_post);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['channel_id'] = $reader->readLong();
		$result['top_msg_id'] = $reader->readInt();
		$result['read_max_id'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['broadcast_id'] = $reader->readLong();
		else:
			$result['broadcast_id'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['broadcast_post'] = $reader->readInt();
		else:
			$result['broadcast_post'] = null;
		endif;
		return new self($result);
	}
}

?>