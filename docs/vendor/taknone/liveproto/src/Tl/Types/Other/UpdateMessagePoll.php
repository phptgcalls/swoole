<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long poll_id pollresults results poll poll
 * @return Update
 */

final class UpdateMessagePoll extends Instance {
	public function request(int $poll_id,object $results,? object $poll = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xaca1657b);
		$flags = 0;
		$flags |= is_null($poll) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($poll_id);
		if(is_null($poll) === false):
			$writer->write($poll->read());
		endif;
		$writer->write($results->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['poll_id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['poll'] = $reader->tgreadObject();
		else:
			$result['poll'] = null;
		endif;
		$result['results'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>