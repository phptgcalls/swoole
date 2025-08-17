<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param richtext text string language
 * @return PageBlock
 */

final class PageBlockPreformatted extends Instance {
	public function request(object $text,string $language) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc070d93e);
		$writer->write($text->read());
		$writer->tgwriteBytes($language);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadObject();
		$result['language'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>