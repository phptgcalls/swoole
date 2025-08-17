<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long msg_id long ping_id
 * @return Pong
 */

final class Pong extends Instance {
	public function request(int $msg_id,int $ping_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x347773c5);
		$writer->writeLong($msg_id);
		$writer->writeLong($ping_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['msg_id'] = $reader->readLong();
		$result['ping_id'] = $reader->readLong();
		return new self($result);
	}
}

?>