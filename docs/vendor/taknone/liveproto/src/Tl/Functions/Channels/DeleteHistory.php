<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel int max_id true for_everyone
 * @return Updates
 */

final class DeleteHistory extends Instance {
	public function request(object $channel,int $max_id,? true $for_everyone = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9baa9647);
		$flags = 0;
		$flags |= is_null($for_everyone) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		$writer->writeInt($max_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>