<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Chatlists;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchatlist chatlist
 * @return Bool
 */

final class HideChatlistUpdates extends Instance {
	public function request(object $chatlist) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x66e486fb);
		$writer->write($chatlist->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>