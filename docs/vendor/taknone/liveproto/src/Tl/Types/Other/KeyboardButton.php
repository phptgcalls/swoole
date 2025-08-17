<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text
 * @return KeyboardButton
 */

final class KeyboardButton extends Instance {
	public function request(string $text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa2fa4880);
		$writer->tgwriteBytes($text);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>