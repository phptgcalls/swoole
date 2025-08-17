<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id long user_id long inviter_id int date int version
 * @return Update
 */

final class UpdateChatParticipantAdd extends Instance {
	public function request(int $chat_id,int $user_id,int $inviter_id,int $date,int $version) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3dda5451);
		$writer->writeLong($chat_id);
		$writer->writeLong($user_id);
		$writer->writeLong($inviter_id);
		$writer->writeInt($date);
		$writer->writeInt($version);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chat_id'] = $reader->readLong();
		$result['user_id'] = $reader->readLong();
		$result['inviter_id'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		$result['version'] = $reader->readInt();
		return new self($result);
	}
}

?>