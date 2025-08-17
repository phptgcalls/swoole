<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param richtext text richtext caption
 * @return PageBlock
 */

final class PageBlockPullquote extends Instance {
	public function request(object $text,object $caption) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4f4456d3);
		$writer->write($text->read());
		$writer->write($caption->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadObject();
		$result['caption'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>