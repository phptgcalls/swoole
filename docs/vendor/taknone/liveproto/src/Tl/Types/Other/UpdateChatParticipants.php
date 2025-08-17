<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param chatparticipants participants
 * @return Update
 */

final class UpdateChatParticipants extends Instance {
	public function request(object $participants) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7761198);
		$writer->write($participants->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['participants'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>