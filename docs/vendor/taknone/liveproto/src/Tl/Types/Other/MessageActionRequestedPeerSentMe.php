<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int button_id Vector<RequestedPeer> peers
 * @return MessageAction
 */

final class MessageActionRequestedPeerSentMe extends Instance {
	public function request(int $button_id,array $peers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x93b31848);
		$writer->writeInt($button_id);
		$writer->tgwriteVector($peers,'RequestedPeer');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['button_id'] = $reader->readInt();
		$result['peers'] = $reader->tgreadVector('RequestedPeer');
		return new self($result);
	}
}

?>