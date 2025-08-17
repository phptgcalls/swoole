<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return payments.StarGifts
 */

final class StarGiftsNotModified extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa388a368);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>