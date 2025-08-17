<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Updates;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int pts int qts int date int seq int unread_count
 * @return updates.State
 */

final class State extends Instance {
	public function request(int $pts,int $qts,int $date,int $seq,int $unread_count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa56c2a3e);
		$writer->writeInt($pts);
		$writer->writeInt($qts);
		$writer->writeInt($date);
		$writer->writeInt($seq);
		$writer->writeInt($unread_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['pts'] = $reader->readInt();
		$result['qts'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		$result['seq'] = $reader->readInt();
		$result['unread_count'] = $reader->readInt();
		return new self($result);
	}
}

?>