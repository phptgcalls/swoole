<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param photo photo
 * @return MessageAction
 */

final class MessageActionSuggestProfilePhoto extends Instance {
	public function request(object $photo) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x57de635e);
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