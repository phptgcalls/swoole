<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param richtext text
 * @return PageBlock
 */

final class PageBlockSubtitle extends Instance {
	public function request(object $text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8ffa9a1f);
		$writer->write($text->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>