<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id Vector<TodoItem> list
 * @return Updates
 */

final class AppendTodoList extends Instance {
	public function request(object $peer,int $msg_id,array $list) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x21a61057);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->tgwriteVector($list,'TodoItem');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>