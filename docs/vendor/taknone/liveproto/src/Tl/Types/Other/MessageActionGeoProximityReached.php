<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer from_id peer to_id int distance
 * @return MessageAction
 */

final class MessageActionGeoProximityReached extends Instance {
	public function request(object $from_id,object $to_id,int $distance) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x98e0d697);
		$writer->write($from_id->read());
		$writer->write($to_id->read());
		$writer->writeInt($distance);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['from_id'] = $reader->tgreadObject();
		$result['to_id'] = $reader->tgreadObject();
		$result['distance'] = $reader->readInt();
		return new self($result);
	}
}

?>