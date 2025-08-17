<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text string copy_text
 * @return KeyboardButton
 */

final class KeyboardButtonCopy extends Instance {
	public function request(string $text,string $copy_text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x75d2698e);
		$writer->tgwriteBytes($text);
		$writer->tgwriteBytes($copy_text);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadBytes();
		$result['copy_text'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>