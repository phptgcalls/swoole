<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string num richtext text
 * @return PageListOrderedItem
 */

final class PageListOrderedItemText extends Instance {
	public function request(string $num,object $text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5e068047);
		$writer->tgwriteBytes($num);
		$writer->write($text->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['num'] = $reader->tgreadBytes();
		$result['text'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>