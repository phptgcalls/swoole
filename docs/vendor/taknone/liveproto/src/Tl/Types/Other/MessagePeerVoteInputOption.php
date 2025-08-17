<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int date
 * @return MessagePeerVote
 */

final class MessagePeerVoteInputOption extends Instance {
	public function request(object $peer,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x74cda504);
		$writer->write($peer->read());
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>