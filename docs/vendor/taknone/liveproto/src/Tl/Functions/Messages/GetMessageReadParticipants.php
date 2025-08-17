<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id
 * @return Vector<ReadParticipantDate>
 */

final class GetMessageReadParticipants extends Instance {
	public function request(object $peer,int $msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x31c1c44f);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>