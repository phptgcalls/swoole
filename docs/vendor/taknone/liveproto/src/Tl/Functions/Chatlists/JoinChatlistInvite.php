<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Chatlists;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string slug Vector<InputPeer> peers
 * @return Updates
 */

final class JoinChatlistInvite extends Instance {
	public function request(string $slug,array $peers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa6b1e39a);
		$writer->tgwriteBytes($slug);
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