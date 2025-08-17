<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstorepaymentpurpose purpose
 * @return Bool
 */

final class CanPurchaseStore extends Instance {
	public function request(object $purpose) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4fdc5ea7);
		$writer->write($purpose->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>