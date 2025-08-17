<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param datajson payment_data
 * @return InputPaymentCredentials
 */

final class InputPaymentCredentialsApplePay extends Instance {
	public function request(object $payment_data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xaa1c39f);
		$writer->write($payment_data->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['payment_data'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>