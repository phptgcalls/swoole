<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id chatparticipant self_participant
 * @return ChatParticipants
 */

final class ChatParticipantsForbidden extends Instance {
	public function request(int $chat_id,? object $self_participant = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8763d3e1);
		$flags = 0;
		$flags |= is_null($self_participant) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($chat_id);
		if(is_null($self_participant) === false):
			$writer->write($self_participant->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['chat_id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['self_participant'] = $reader->tgreadObject();
		else:
			$result['self_participant'] = null;
		endif;
		return new self($result);
	}
}

?>