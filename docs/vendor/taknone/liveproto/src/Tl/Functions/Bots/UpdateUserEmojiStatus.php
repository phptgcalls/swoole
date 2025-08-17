<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id emojistatus emoji_status
 * @return Bool
 */

final class UpdateUserEmojiStatus extends Instance {
	public function request(object $user_id,object $emoji_status) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xed9f30c5);
		$writer->write($user_id->read());
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