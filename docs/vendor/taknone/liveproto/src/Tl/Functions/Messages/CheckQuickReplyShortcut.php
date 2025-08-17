<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string shortcut
 * @return Bool
 */

final class CheckQuickReplyShortcut extends Instance {
	public function request(string $shortcut) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf1d0fbd3);
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