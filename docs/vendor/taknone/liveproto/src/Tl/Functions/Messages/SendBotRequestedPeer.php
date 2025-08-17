<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id int button_id Vector<InputPeer> requested_peers
 * @return Updates
 */

final class SendBotRequestedPeer extends Instance {
	public function request(object $peer,int $msg_id,int $button_id,array $requested_peers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x91b2d060);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->writeInt($button_id);
		$writer->tgwriteVector($requested_peers,'InputPeer');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>