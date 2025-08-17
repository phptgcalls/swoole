<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer bytes option int date
 * @return MessagePeerVote
 */

final class MessagePeerVote extends Instance {
	public function request(object $peer,string $option,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb6cc2d5c);
		$writer->write($peer->read());
		$writer->tgwriteBytes($option);
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['option'] = $reader->tgreadBytes();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>