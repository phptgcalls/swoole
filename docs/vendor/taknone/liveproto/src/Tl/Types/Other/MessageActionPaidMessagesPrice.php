<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long stars true broadcast_messages_allowed
 * @return MessageAction
 */

final class MessageActionPaidMessagesPrice extends Instance {
	public function request(int $stars,? true $broadcast_messages_allowed = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x84b88578);
		$flags = 0;
		$flags |= is_null($broadcast_messages_allowed) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($stars);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['broadcast_messages_allowed'] = true;
		else:
			$result['broadcast_messages_allowed'] = false;
		endif;
		$result['stars'] = $reader->readLong();
		return new self($result);
	}
}

?>