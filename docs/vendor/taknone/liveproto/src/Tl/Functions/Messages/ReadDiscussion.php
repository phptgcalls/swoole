<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id int read_max_id
 * @return Bool
 */

final class ReadDiscussion extends Instance {
	public function request(object $peer,int $msg_id,int $read_max_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf731a9f4);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->writeInt($read_max_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>