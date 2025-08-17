<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<KeyboardButton> buttons
 * @return KeyboardButtonRow
 */

final class KeyboardButtonRow extends Instance {
	public function request(array $buttons) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x77608b83);
		$writer->tgwriteVector($buttons,'KeyboardButton');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['buttons'] = $reader->tgreadVector('KeyboardButton');
		return new self($result);
	}
}

?>