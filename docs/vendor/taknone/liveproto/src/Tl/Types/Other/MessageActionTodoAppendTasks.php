<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<TodoItem> list
 * @return MessageAction
 */

final class MessageActionTodoAppendTasks extends Instance {
	public function request(array $list) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc7edbc83);
		$writer->tgwriteVector($list,'TodoItem');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['list'] = $reader->tgreadVector('TodoItem');
		return new self($result);
	}
}

?>