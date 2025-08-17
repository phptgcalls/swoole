<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param emojistatus emoji_status
 * @return Bool
 */

final class UpdateEmojiStatus extends Instance {
	public function request(object $emoji_status) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfbd3de6b);
		$writer->write($emoji_status->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>