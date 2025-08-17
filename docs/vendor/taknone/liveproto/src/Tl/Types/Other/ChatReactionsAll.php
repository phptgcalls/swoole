<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true allow_custom
 * @return ChatReactions
 */

final class ChatReactionsAll extends Instance {
	public function request(? true $allow_custom = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x52928bca);
		$flags = 0;
		$flags |= is_null($allow_custom) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['allow_custom'] = true;
		else:
			$result['allow_custom'] = false;
		endif;
		return new self($result);
	}
}

?>