<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id
 * @return MessageAction
 */

final class MessageActionChatMigrateTo extends Instance {
	public function request(int $channel_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe1037f92);
		$writer->writeLong($channel_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel_id'] = $reader->readLong();
		return new self($result);
	}
}

?>