<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer true dark true ton
 * @return payments.StarsRevenueStats
 */

final class GetStarsRevenueStats extends Instance {
	public function request(object $peer,? true $dark = null,? true $ton = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd91ffad6);
		$flags = 0;
		$flags |= is_null($dark) ? 0 : (1 << 0);
		$flags |= is_null($ton) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>