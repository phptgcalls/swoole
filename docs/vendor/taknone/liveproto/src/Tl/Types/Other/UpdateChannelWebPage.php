<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id webpage webpage int pts int pts_count
 * @return Update
 */

final class UpdateChannelWebPage extends Instance {
	public function request(int $channel_id,object $webpage,int $pts,int $pts_count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2f2ba99f);
		$writer->writeLong($channel_id);
		$writer->write($webpage->read());
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel_id'] = $reader->readLong();
		$result['webpage'] = $reader->tgreadObject();
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		return new self($result);
	}
}

?>