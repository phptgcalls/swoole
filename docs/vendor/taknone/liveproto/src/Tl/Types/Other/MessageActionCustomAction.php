<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string message
 * @return MessageAction
 */

final class MessageActionCustomAction extends Instance {
	public function request(string $message) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfae69f56);
		$writer->tgwriteBytes($message);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['message'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>