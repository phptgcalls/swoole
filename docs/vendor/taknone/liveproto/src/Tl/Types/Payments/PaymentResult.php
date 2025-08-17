<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param updates updates
 * @return payments.PaymentResult
 */

final class PaymentResult extends Instance {
	public function request(object $updates) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4e5f810d);
		$writer->write($updates->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['updates'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>