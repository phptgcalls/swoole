<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long form_id inputinvoice invoice
 * @return payments.PaymentResult
 */

final class SendStarsForm extends Instance {
	public function request(int $form_id,object $invoice) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7998c914);
		$writer->writeLong($form_id);
		$writer->write($invoice->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>