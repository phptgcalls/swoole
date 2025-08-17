<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstorepaymentpurpose purpose
 * @return InputInvoice
 */

final class InputInvoiceStars extends Instance {
	public function request(object $purpose) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x65f00ce3);
		$writer->write($purpose->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['purpose'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>