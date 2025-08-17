<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id paidreactionprivacy private
 * @return Bool
 */

final class TogglePaidReactionPrivacy extends Instance {
	public function request(object $peer,int $msg_id,object $private) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x435885b5);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->write($private->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>