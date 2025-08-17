<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgame id
 * @return InputMedia
 */

final class InputMediaGame extends Instance {
	public function request(object $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd33f43f3);
		$writer->write($id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>