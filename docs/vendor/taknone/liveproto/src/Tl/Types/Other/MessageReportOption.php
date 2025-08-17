<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text bytes option
 * @return MessageReportOption
 */

final class MessageReportOption extends Instance {
	public function request(string $text,string $option) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7903e3d9);
		$writer->tgwriteBytes($text);
		$writer->tgwriteBytes($option);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadBytes();
		$result['option'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>