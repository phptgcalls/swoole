<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id Vector<ChatParticipant> participants int version
 * @return ChatParticipants
 */

final class ChatParticipants extends Instance {
	public function request(int $chat_id,array $participants,int $version) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3cbc93f8);
		$writer->writeLong($chat_id);
		$writer->tgwriteVector($participants,'ChatParticipant');
		$writer->writeInt($version);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chat_id'] = $reader->readLong();
		$result['participants'] = $reader->tgreadVector('ChatParticipant');
		$result['version'] = $reader->readInt();
		return new self($result);
	}
}

?>