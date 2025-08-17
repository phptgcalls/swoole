<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string offset true missing_balance
 * @return payments.StarsStatus
 */

final class GetStarsSubscriptions extends Instance {
	public function request(object $peer,string $offset,? true $missing_balance = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x32512c5);
		$flags = 0;
		$flags |= is_null($missing_balance) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->tgwriteBytes($offset);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>