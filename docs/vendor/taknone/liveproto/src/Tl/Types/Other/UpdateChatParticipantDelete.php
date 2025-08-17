<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id long user_id int version
 * @return Update
 */

final class UpdateChatParticipantDelete extends Instance {
	public function request(int $chat_id,int $user_id,int $version) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe32f3d77);
		$writer->writeLong($chat_id);
		$writer->writeLong($user_id);
		$writer->writeInt($version);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chat_id'] = $reader->readLong();
		$result['user_id'] = $reader->readLong();
		$result['version'] = $reader->readInt();
		return new self($result);
	}
}

?>