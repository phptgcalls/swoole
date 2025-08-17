<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer Vector<bytes> options int date
 * @return MessagePeerVote
 */

final class MessagePeerVoteMultiple extends Instance {
	public function request(object $peer,array $options,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4628f6e6);
		$writer->write($peer->read());
		$writer->tgwriteVector($options,'bytes');
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['options'] = $reader->tgreadVector('bytes');
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>