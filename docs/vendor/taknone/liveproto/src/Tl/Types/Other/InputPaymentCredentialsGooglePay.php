<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param datajson payment_token
 * @return InputPaymentCredentials
 */

final class InputPaymentCredentialsGooglePay extends Instance {
	public function request(object $payment_token) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8ac32801);
		$writer->write($payment_token->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['payment_token'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>