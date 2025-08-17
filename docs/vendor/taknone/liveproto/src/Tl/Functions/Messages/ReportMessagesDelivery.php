<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer Vector<int> id true push
 * @return Bool
 */

final class ReportMessagesDelivery extends Instance {
	public function request(object $peer,array $id,? true $push = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5a6d7395);
		$flags = 0;
		$flags |= is_null($push) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->tgwriteVector($id,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>