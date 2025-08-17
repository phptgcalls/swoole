<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long req_msg_id
 * @return RpcDropAnswer
 */

final class RpcDropAnswer extends Instance {
	public function request(int $req_msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x58e4a740);
		$writer->writeLong($req_msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>