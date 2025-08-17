<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id int id int views
 * @return Update
 */

final class UpdateChannelMessageViews extends Instance {
	public function request(int $channel_id,int $id,int $views) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf226ac08);
		$writer->writeLong($channel_id);
		$writer->writeInt($id);
		$writer->writeInt($views);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel_id'] = $reader->readLong();
		$result['id'] = $reader->readInt();
		$result['views'] = $reader->readInt();
		return new self($result);
	}
}

?>