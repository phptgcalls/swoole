<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int msg_id
 * @return InputGroupCall
 */

final class InputGroupCallInviteMessage extends Instance {
	public function request(int $msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8c10603f);
		$writer->writeInt($msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['msg_id'] = $reader->readInt();
		return new self($result);
	}
}

?>