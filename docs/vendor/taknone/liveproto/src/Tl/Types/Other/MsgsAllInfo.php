<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> msg_ids string info
 * @return MsgsAllInfo
 */

final class MsgsAllInfo extends Instance {
	public function request(array $msg_ids,string $info) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8cc0d131);
		$writer->tgwriteVector($msg_ids,'long');
		$writer->tgwriteBytes($info);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['msg_ids'] = $reader->tgreadVector('long');
		$result['info'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>