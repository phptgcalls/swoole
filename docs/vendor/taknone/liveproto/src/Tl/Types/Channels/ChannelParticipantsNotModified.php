<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return channels.ChannelParticipants
 */

final class ChannelParticipantsNotModified extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf0173fe9);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>