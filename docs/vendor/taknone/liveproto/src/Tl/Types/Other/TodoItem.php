<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id textwithentities title
 * @return TodoItem
 */

final class TodoItem extends Instance {
	public function request(int $id,object $title) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcba9a52f);
		$writer->writeInt($id);
		$writer->write($title->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readInt();
		$result['title'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>