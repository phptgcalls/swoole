<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int shortcut_id Vector<int> messages
 * @return Update
 */

final class UpdateDeleteQuickReplyMessages extends Instance {
	public function request(int $shortcut_id,array $messages) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x566fe7cd);
		$writer->writeInt($shortcut_id);
		$writer->tgwriteVector($messages,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['shortcut_id'] = $reader->readInt();
		$result['messages'] = $reader->tgreadVector('int');
		return new self($result);
	}
}

?>