<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param richtext text string email
 * @return RichText
 */

final class TextEmail extends Instance {
	public function request(object $text,string $email) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xde5a0dd6);
		$writer->write($text->read());
		$writer->tgwriteBytes($email);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadObject();
		$result['email'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>