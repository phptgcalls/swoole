<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<int> completed Vector<int> incompleted
 * @return MessageAction
 */

final class MessageActionTodoCompletions extends Instance {
	public function request(array $completed,array $incompleted) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcc7c5c89);
		$writer->tgwriteVector($completed,'int');
		$writer->tgwriteVector($incompleted,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['completed'] = $reader->tgreadVector('int');
		$result['incompleted'] = $reader->tgreadVector('int');
		return new self($result);
	}
}

?>