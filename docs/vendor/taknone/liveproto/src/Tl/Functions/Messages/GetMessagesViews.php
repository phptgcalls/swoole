<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer Vector<int> id bool increment
 * @return messages.MessageViews
 */

final class GetMessagesViews extends Instance {
	public function request(object $peer,array $id,bool $increment) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5784d3e1);
		$writer->write($peer->read());
		$writer->tgwriteVector($id,'int');
		$writer->tgwriteBool($increment);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>