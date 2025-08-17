<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param textwithentities text bytes option
 * @return PollAnswer
 */

final class PollAnswer extends Instance {
	public function request(object $text,string $option) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xff16e2ca);
		$writer->write($text->read());
		$writer->tgwriteBytes($option);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadObject();
		$result['option'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>