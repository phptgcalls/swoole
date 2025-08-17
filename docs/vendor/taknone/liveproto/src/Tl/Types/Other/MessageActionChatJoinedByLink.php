<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long inviter_id
 * @return MessageAction
 */

final class MessageActionChatJoinedByLink extends Instance {
	public function request(int $inviter_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x31224c3);
		$writer->writeLong($inviter_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['inviter_id'] = $reader->readLong();
		return new self($result);
	}
}

?>