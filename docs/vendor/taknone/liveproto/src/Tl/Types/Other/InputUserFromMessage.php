<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id long user_id
 * @return InputUser
 */

final class InputUserFromMessage extends Instance {
	public function request(object $peer,int $msg_id,int $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1da448e2);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->writeLong($user_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['msg_id'] = $reader->readInt();
		$result['user_id'] = $reader->readLong();
		return new self($result);
	}
}

?>