<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param poll poll pollresults results
 * @return MessageMedia
 */

final class MessageMediaPoll extends Instance {
	public function request(object $poll,object $results) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4bd6e798);
		$writer->write($poll->read());
		$writer->write($results->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['poll'] = $reader->tgreadObject();
		$result['results'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>