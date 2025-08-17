<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> msg_ids
 * @return MsgResendReq
 */

final class MsgResendReq extends Instance {
	public function request(array $msg_ids) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7d861a08);
		$writer->tgwriteVector($msg_ids,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['msg_ids'] = $reader->tgreadVector('long');
		return new self($result);
	}
}

?>