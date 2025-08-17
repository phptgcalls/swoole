<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text string start_param
 * @return InlineBotSwitchPM
 */

final class InlineBotSwitchPM extends Instance {
	public function request(string $text,string $start_param) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3c20629f);
		$writer->tgwriteBytes($text);
		$writer->tgwriteBytes($start_param);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadBytes();
		$result['start_param'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>