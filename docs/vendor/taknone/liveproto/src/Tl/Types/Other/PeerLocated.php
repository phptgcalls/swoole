<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int expires int distance
 * @return PeerLocated
 */

final class PeerLocated extends Instance {
	public function request(object $peer,int $expires,int $distance) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xca461b5d);
		$writer->write($peer->read());
		$writer->writeInt($expires);
		$writer->writeInt($distance);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['expires'] = $reader->readInt();
		$result['distance'] = $reader->readInt();
		return new self($result);
	}
}

?>