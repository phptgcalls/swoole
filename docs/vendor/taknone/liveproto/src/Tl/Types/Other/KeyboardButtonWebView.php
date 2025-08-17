<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text string url
 * @return KeyboardButton
 */

final class KeyboardButtonWebView extends Instance {
	public function request(string $text,string $url) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x13767230);
		$writer->tgwriteBytes($text);
		$writer->tgwriteBytes($url);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadBytes();
		$result['url'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>