<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string shortcut
 * @return InputQuickReplyShortcut
 */

final class InputQuickReplyShortcut extends Instance {
	public function request(string $shortcut) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x24596d41);
		$writer->tgwriteBytes($shortcut);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['shortcut'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>