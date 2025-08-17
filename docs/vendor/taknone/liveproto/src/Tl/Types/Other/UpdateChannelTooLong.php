<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id int pts
 * @return Update
 */

final class UpdateChannelTooLong extends Instance {
	public function request(int $channel_id,? int $pts = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x108d941f);
		$flags = 0;
		$flags |= is_null($pts) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($channel_id);
		if(is_null($pts) === false):
			$writer->writeInt($pts);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['channel_id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['pts'] = $reader->readInt();
		else:
			$result['pts'] = null;
		endif;
		return new self($result);
	}
}

?>