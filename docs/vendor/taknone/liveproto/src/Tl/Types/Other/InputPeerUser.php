<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id long access_hash
 * @return InputPeer
 */

final class InputPeerUser extends Instance {
	public function request(int $user_id,int $access_hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdde8a54c);
		$writer->writeLong($user_id);
		$writer->writeLong($access_hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		return new self($result);
	}
}

?>