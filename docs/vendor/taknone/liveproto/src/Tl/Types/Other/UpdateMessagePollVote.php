<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long poll_id peer peer Vector<bytes> options int qts
 * @return Update
 */

final class UpdateMessagePollVote extends Instance {
	public function request(int $poll_id,object $peer,array $options,int $qts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x24f40e77);
		$writer->writeLong($poll_id);
		$writer->write($peer->read());
		$writer->tgwriteVector($options,'bytes');
		$writer->writeInt($qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['poll_id'] = $reader->readLong();
		$result['peer'] = $reader->tgreadObject();
		$result['options'] = $reader->tgreadVector('bytes');
		$result['qts'] = $reader->readInt();
		return new self($result);
	}
}

?>