<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id
 * @return Update
 */

final class UpdateChat extends Instance {
	public function request(int $chat_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf89a6a4e);
		$writer->writeLong($chat_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chat_id'] = $reader->readLong();
		return new self($result);
	}
}

?>