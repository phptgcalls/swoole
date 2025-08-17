<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param textwithentities title Vector<TodoItem> list true others_can_append true others_can_complete
 * @return TodoList
 */

final class TodoList extends Instance {
	public function request(object $title,array $list,? true $others_can_append = null,? true $others_can_complete = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x49b92a26);
		$flags = 0;
		$flags |= is_null($others_can_append) ? 0 : (1 << 0);
		$flags |= is_null($others_can_complete) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($title->read());
		$writer->tgwriteVector($list,'TodoItem');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['others_can_append'] = true;
		else:
			$result['others_can_append'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['others_can_complete'] = true;
		else:
			$result['others_can_complete'] = false;
		endif;
		$result['title'] = $reader->tgreadObject();
		$result['list'] = $reader->tgreadVector('TodoItem');
		return new self($result);
	}
}

?>