<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return StarsTransactionPeer
 */

final class StarsTransactionPeerAppStore extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb457b375);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>