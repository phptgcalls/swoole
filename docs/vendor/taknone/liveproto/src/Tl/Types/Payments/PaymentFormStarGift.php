<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long form_id invoice invoice
 * @return payments.PaymentForm
 */

final class PaymentFormStarGift extends Instance {
	public function request(int $form_id,object $invoice) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb425cfe1);
		$writer->writeLong($form_id);
		$writer->write($invoice->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['form_id'] = $reader->readLong();
		$result['invoice'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>