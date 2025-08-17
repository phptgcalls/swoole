<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param photo photo
 * @return MessageAction
 */

final class MessageActionChatEditPhoto extends Instance {
	public function request(object $photo) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7fcb13a8);
		$writer->write($photo->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['photo'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>