<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer_id int date
 * @return PeerBlocked
 */

final class PeerBlocked extends Instance {
	public function request(object $peer_id,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe8fd8014);
		$writer->write($peer_id->read());
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer_id'] = $reader->tgreadObject();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>