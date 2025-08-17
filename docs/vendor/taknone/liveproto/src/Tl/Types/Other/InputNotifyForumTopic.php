<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int top_msg_id
 * @return InputNotifyPeer
 */

final class InputNotifyForumTopic extends Instance {
	public function request(object $peer,int $top_msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5c467992);
		$writer->write($peer->read());
		$writer->writeInt($top_msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['top_msg_id'] = $reader->readInt();
		return new self($result);
	}
}

?>