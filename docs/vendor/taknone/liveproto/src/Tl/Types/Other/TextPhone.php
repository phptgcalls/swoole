<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param richtext text string phone
 * @return RichText
 */

final class TextPhone extends Instance {
	public function request(object $text,string $phone) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1ccb966a);
		$writer->write($text->read());
		$writer->tgwriteBytes($phone);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadObject();
		$result['phone'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>