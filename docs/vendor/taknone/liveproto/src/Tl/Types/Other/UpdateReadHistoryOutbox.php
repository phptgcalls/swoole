<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int max_id int pts int pts_count
 * @return Update
 */

final class UpdateReadHistoryOutbox extends Instance {
	public function request(object $peer,int $max_id,int $pts,int $pts_count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2f2f21bf);
		$writer->write($peer->read());
		$writer->writeInt($max_id);
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['max_id'] = $reader->readInt();
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		return new self($result);
	}
}

?>