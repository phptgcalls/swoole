<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long req_msg_id string info
 * @return MsgsStateInfo
 */

final class MsgsStateInfo extends Instance {
	public function request(int $req_msg_id,string $info) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4deb57d);
		$writer->writeLong($req_msg_id);
		$writer->tgwriteBytes($info);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['req_msg_id'] = $reader->readLong();
		$result['info'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>