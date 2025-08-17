<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int shortcut_id string shortcut
 * @return Bool
 */

final class EditQuickReplyShortcut extends Instance {
	public function request(int $shortcut_id,string $shortcut) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5c003cef);
		$writer->writeInt($shortcut_id);
		$writer->tgwriteBytes($shortcut);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>