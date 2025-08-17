<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputinvoice invoice datajson theme_params
 * @return payments.PaymentForm
 */

final class GetPaymentForm extends Instance {
	public function request(object $invoice,? object $theme_params = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x37148dbb);
		$flags = 0;
		$flags |= is_null($theme_params) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($invoice->read());
		if(is_null($theme_params) === false):
			$writer->write($theme_params->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>