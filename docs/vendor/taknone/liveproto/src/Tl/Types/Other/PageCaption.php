<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param richtext text richtext credit
 * @return PageCaption
 */

final class PageCaption extends Instance {
	public function request(object $text,object $credit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6f747657);
		$writer->write($text->read());
		$writer->write($credit->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadObject();
		$result['credit'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>