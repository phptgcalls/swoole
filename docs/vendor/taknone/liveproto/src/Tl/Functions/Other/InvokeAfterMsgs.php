<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> msg_ids x query
 * @return X
 */

final class InvokeAfterMsgs extends Instance {
	public function request(array $msg_ids,object $query) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3dc4b4f0);
		$writer->tgwriteVector($msg_ids,'long');
		$writer->write($query->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>