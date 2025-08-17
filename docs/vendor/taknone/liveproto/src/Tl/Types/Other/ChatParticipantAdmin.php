<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id long inviter_id int date
 * @return ChatParticipant
 */

final class ChatParticipantAdmin extends Instance {
	public function request(int $user_id,int $inviter_id,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa0933f5b);
		$writer->writeLong($user_id);
		$writer->writeLong($inviter_id);
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['inviter_id'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>