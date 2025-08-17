<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text string data
 * @return MessageAction
 */

final class MessageActionWebViewDataSentMe extends Instance {
	public function request(string $text,string $data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x47dd8079);
		$writer->tgwriteBytes($text);
		$writer->tgwriteBytes($data);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadBytes();
		$result['data'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>