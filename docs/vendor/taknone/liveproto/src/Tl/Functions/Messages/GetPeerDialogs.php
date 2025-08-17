<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputDialogPeer> peers
 * @return messages.PeerDialogs
 */

final class GetPeerDialogs extends Instance {
	public function request(array $peers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe470bcfd);
		$writer->tgwriteVector($peers,'InputDialogPeer');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>