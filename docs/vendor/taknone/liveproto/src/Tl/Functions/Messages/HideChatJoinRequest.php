<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputuser user_id true approved
 * @return Updates
 */

final class HideChatJoinRequest extends Instance {
	public function request(object $peer,object $user_id,? true $approved = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7fe7e815);
		$flags = 0;
		$flags |= is_null($approved) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->write($user_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>