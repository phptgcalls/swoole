<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id int max_id int still_unread_count int pts int folder_id
 * @return Update
 */

final class UpdateReadChannelInbox extends Instance {
	public function request(int $channel_id,int $max_id,int $still_unread_count,int $pts,? int $folder_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x922e6e10);
		$flags = 0;
		$flags |= is_null($folder_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($folder_id) === false):
			$writer->writeInt($folder_id);
		endif;
		$writer->writeLong($channel_id);
		$writer->writeInt($max_id);
		$writer->writeInt($still_unread_count);
		$writer->writeInt($pts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['folder_id'] = $reader->readInt();
		else:
			$result['folder_id'] = null;
		endif;
		$result['channel_id'] = $reader->readLong();
		$result['max_id'] = $reader->readInt();
		$result['still_unread_count'] = $reader->readInt();
		$result['pts'] = $reader->readInt();
		return new self($result);
	}
}

?>