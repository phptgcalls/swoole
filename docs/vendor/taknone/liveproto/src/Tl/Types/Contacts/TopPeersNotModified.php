<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return contacts.TopPeers
 */

final class TopPeersNotModified extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xde266ef5);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>