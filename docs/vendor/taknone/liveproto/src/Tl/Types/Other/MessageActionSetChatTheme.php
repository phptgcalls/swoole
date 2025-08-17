<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string emoticon
 * @return MessageAction
 */

final class MessageActionSetChatTheme extends Instance {
	public function request(string $emoticon) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xaa786345);
		$writer->tgwriteBytes($emoticon);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['emoticon'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>