<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return ChannelParticipantsFilter
 */

final class ChannelParticipantsAdmins extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb4608969);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>