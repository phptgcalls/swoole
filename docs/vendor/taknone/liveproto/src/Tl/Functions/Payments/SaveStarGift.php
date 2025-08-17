<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputsavedstargift stargift true unsave
 * @return Bool
 */

final class SaveStarGift extends Instance {
	public function request(object $stargift,? true $unsave = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2a2a697c);
		$flags = 0;
		$flags |= is_null($unsave) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($stargift->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>