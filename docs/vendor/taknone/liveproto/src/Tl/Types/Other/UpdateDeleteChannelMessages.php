<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id Vector<int> messages int pts int pts_count
 * @return Update
 */

final class UpdateDeleteChannelMessages extends Instance {
	public function request(int $channel_id,array $messages,int $pts,int $pts_count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc32d5b12);
		$writer->writeLong($channel_id);
		$writer->tgwriteVector($messages,'int');
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel_id'] = $reader->readLong();
		$result['messages'] = $reader->tgreadVector('int');
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		return new self($result);
	}
}

?>