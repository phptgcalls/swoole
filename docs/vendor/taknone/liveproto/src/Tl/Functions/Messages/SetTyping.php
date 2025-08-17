<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer sendmessageaction action int top_msg_id
 * @return Bool
 */

final class SetTyping extends Instance {
	public function request(object $peer,object $action,? int $top_msg_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x58943ee2);
		$flags = 0;
		$flags |= is_null($top_msg_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($top_msg_id) === false):
			$writer->writeInt($top_msg_id);
		endif;
		$writer->write($action->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>