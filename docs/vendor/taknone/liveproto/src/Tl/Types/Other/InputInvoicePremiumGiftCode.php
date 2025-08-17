<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstorepaymentpurpose purpose premiumgiftcodeoption option
 * @return InputInvoice
 */

final class InputInvoicePremiumGiftCode extends Instance {
	public function request(object $purpose,object $option) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x98986c0d);
		$writer->write($purpose->read());
		$writer->write($option->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['purpose'] = $reader->tgreadObject();
		$result['option'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>