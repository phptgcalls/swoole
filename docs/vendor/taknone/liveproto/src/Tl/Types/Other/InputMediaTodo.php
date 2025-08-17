<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param todolist todo
 * @return InputMedia
 */

final class InputMediaTodo extends Instance {
	public function request(object $todo) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9fc55fde);
		$writer->write($todo->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['todo'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>