<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id
 * @return messages.MessageEditData
 */

final class GetMessageEditData extends Instance {
	public function request(object $peer,int $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfda68d36);
		$writer->write($peer->read());
		$writer->writeInt($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>