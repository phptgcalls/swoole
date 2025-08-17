<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param todolist todo Vector<TodoCompletion> completions
 * @return MessageMedia
 */

final class MessageMediaToDo extends Instance {
	public function request(object $todo,? array $completions = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8a53b014);
		$flags = 0;
		$flags |= is_null($completions) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($todo->read());
		if(is_null($completions) === false):
			$writer->tgwriteVector($completions,'TodoCompletion');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['todo'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['completions'] = $reader->tgreadVector('TodoCompletion');
		else:
			$result['completions'] = null;
		endif;
		return new self($result);
	}
}

?>