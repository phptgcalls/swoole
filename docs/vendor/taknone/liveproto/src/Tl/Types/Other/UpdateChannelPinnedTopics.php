<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id Vector<int> order
 * @return Update
 */

final class UpdateChannelPinnedTopics extends Instance {
	public function request(int $channel_id,? array $order = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfe198602);
		$flags = 0;
		$flags |= is_null($order) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($channel_id);
		if(is_null($order) === false):
			$writer->tgwriteVector($order,'int');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['channel_id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['order'] = $reader->tgreadVector('int');
		else:
			$result['order'] = null;
		endif;
		return new self($result);
	}
}

?>