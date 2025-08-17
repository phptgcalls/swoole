<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true caption
 * @return messages.MessageEditData
 */

final class MessageEditData extends Instance {
	public function request(? true $caption = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x26b5dde6);
		$flags = 0;
		$flags |= is_null($caption) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['caption'] = true;
		else:
			$result['caption'] = false;
		endif;
		return new self($result);
	}
}

?>