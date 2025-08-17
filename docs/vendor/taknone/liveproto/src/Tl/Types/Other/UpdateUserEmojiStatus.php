<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id emojistatus emoji_status
 * @return Update
 */

final class UpdateUserEmojiStatus extends Instance {
	public function request(int $user_id,object $emoji_status) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x28373599);
		$writer->writeLong($user_id);
		$writer->write($emoji_status->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['emoji_status'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>