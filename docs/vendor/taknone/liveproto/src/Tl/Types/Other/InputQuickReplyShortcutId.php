<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int shortcut_id
 * @return InputQuickReplyShortcut
 */

final class InputQuickReplyShortcutId extends Instance {
	public function request(int $shortcut_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1190cf1);
		$writer->writeInt($shortcut_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['shortcut_id'] = $reader->readInt();
		return new self($result);
	}
}

?>