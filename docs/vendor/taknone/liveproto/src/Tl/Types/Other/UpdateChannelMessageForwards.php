<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id int id int forwards
 * @return Update
 */

final class UpdateChannelMessageForwards extends Instance {
	public function request(int $channel_id,int $id,int $forwards) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd29a27f4);
		$writer->writeLong($channel_id);
		$writer->writeInt($id);
		$writer->writeInt($forwards);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel_id'] = $reader->readLong();
		$result['id'] = $reader->readInt();
		$result['forwards'] = $reader->readInt();
		return new self($result);
	}
}

?>