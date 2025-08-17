<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<PeerLocated> peers
 * @return Update
 */

final class UpdatePeerLocated extends Instance {
	public function request(array $peers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb4afcfb0);
		$writer->tgwriteVector($peers,'PeerLocated');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peers'] = $reader->tgreadVector('PeerLocated');
		return new self($result);
	}
}

?>