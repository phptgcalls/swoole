<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int msg_id
 * @return Updates
 */

final class DeclineConferenceCallInvite extends Instance {
	public function request(int $msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3c479971);
		$writer->writeInt($msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>