<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer true for_paid_reactions
 * @return channels.SendAsPeers
 */

final class GetSendAs extends Instance {
	public function request(object $peer,? true $for_paid_reactions = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe785a43f);
		$flags = 0;
		$flags |= is_null($for_paid_reactions) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>