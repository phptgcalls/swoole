<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title
 * @return MessageAction
 */

final class MessageActionChatEditTitle extends Instance {
	public function request(string $title) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb5a1ce5a);
		$writer->tgwriteBytes($title);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['title'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>