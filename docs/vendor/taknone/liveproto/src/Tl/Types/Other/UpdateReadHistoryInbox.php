<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int max_id int still_unread_count int pts int pts_count int folder_id
 * @return Update
 */

final class UpdateReadHistoryInbox extends Instance {
	public function request(object $peer,int $max_id,int $still_unread_count,int $pts,int $pts_count,? int $folder_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9c974fdf);
		$flags = 0;
		$flags |= is_null($folder_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($folder_id) === false):
			$writer->writeInt($folder_id);
		endif;
		$writer->write($peer->read());
		$writer->writeInt($max_id);
		$writer->writeInt($still_unread_count);
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
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
		$result['peer'] = $reader->tgreadObject();
		$result['max_id'] = $reader->readInt();
		$result['still_unread_count'] = $reader->readInt();
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		return new self($result);
	}
}

?>