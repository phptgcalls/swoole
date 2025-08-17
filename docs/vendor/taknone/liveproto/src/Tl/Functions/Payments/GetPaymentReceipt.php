<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id
 * @return payments.PaymentReceipt
 */

final class GetPaymentReceipt extends Instance {
	public function request(object $peer,int $msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2478d1cc);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>