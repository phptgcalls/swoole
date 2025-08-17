<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id peer saved_peer_id true exception
 * @return Update
 */

final class UpdateMonoForumNoPaidException extends Instance {
	public function request(int $channel_id,object $saved_peer_id,? true $exception = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9f812b08);
		$flags = 0;
		$flags |= is_null($exception) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($channel_id);
		$writer->write($saved_peer_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['exception'] = true;
		else:
			$result['exception'] = false;
		endif;
		$result['channel_id'] = $reader->readLong();
		$result['saved_peer_id'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>