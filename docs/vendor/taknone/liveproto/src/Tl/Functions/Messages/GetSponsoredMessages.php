<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id
 * @return messages.SponsoredMessages
 */

final class GetSponsoredMessages extends Instance {
	public function request(object $peer,? int $msg_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3d6ce850);
		$flags = 0;
		$flags |= is_null($msg_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($msg_id) === false):
			$writer->writeInt($msg_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>