<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id long user_id bool is_admin int version
 * @return Update
 */

final class UpdateChatParticipantAdmin extends Instance {
	public function request(int $chat_id,int $user_id,bool $is_admin,int $version) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd7ca61a2);
		$writer->writeLong($chat_id);
		$writer->writeLong($user_id);
		$writer->tgwriteBool($is_admin);
		$writer->writeInt($version);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chat_id'] = $reader->readLong();
		$result['user_id'] = $reader->readLong();
		$result['is_admin'] = $reader->tgreadBool();
		$result['version'] = $reader->readInt();
		return new self($result);
	}
}

?>