<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Chatlists;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchatlist chatlist Vector<InputPeer> peers
 * @return Updates
 */

final class JoinChatlistUpdates extends Instance {
	public function request(object $chatlist,array $peers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe089f8f5);
		$writer->write($chatlist->read());
		$writer->tgwriteVector($peers,'InputPeer');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>