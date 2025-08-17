<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int shortcut_id
 * @return Bool
 */

final class DeleteQuickReplyShortcut extends Instance {
	public function request(int $shortcut_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3cc04740);
		$writer->writeInt($shortcut_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>