<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return Vector<StarsGiveawayOption>
 */

final class GetStarsGiveawayOptions extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbd1efd3e);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>