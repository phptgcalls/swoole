<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int msg_id
 * @return Update
 */

final class UpdateGeoLiveViewed extends Instance {
	public function request(object $peer,int $msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x871fb939);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['msg_id'] = $reader->readInt();
		return new self($result);
	}
}

?>