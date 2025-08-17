<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputinvoice invoice paymentrequestedinfo info true save
 * @return payments.ValidatedRequestedInfo
 */

final class ValidateRequestedInfo extends Instance {
	public function request(object $invoice,object $info,? true $save = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb6c8f12b);
		$flags = 0;
		$flags |= is_null($save) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($invoice->read());
		$writer->write($info->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>