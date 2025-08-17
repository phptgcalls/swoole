<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id inputpeer reaction_peer
 * @return Bool
 */

final class ReportReaction extends Instance {
	public function request(object $peer,int $id,object $reaction_peer) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3f64c076);
		$writer->write($peer->read());
		$writer->writeInt($id);
		$writer->write($reaction_peer->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>