<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int chat_id true delete_history
 * @return Bool
 */

final class DiscardEncryption extends Instance {
	public function request(int $chat_id,? true $delete_history = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf393aea0);
		$flags = 0;
		$flags |= is_null($delete_history) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($chat_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>