<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long form_id inputinvoice invoice inputpaymentcredentials credentials string requested_info_id string shipping_option_id long tip_amount
 * @return payments.PaymentResult
 */

final class SendPaymentForm extends Instance {
	public function request(int $form_id,object $invoice,object $credentials,? string $requested_info_id = null,? string $shipping_option_id = null,? int $tip_amount = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2d03522f);
		$flags = 0;
		$flags |= is_null($requested_info_id) ? 0 : (1 << 0);
		$flags |= is_null($shipping_option_id) ? 0 : (1 << 1);
		$flags |= is_null($tip_amount) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeLong($form_id);
		$writer->write($invoice->read());
		if(is_null($requested_info_id) === false):
			$writer->tgwriteBytes($requested_info_id);
		endif;
		if(is_null($shipping_option_id) === false):
			$writer->tgwriteBytes($shipping_option_id);
		endif;
		$writer->write($credentials->read());
		if(is_null($tip_amount) === false):
			$writer->writeLong($tip_amount);
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