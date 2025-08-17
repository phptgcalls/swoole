<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param richtext text string name
 * @return RichText
 */

final class TextAnchor extends Instance {
	public function request(object $text,string $name) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x35553762);
		$writer->write($text->read());
		$writer->tgwriteBytes($name);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadObject();
		$result['name'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>