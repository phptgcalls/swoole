<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string number
 * @return payments.BankCardData
 */

final class GetBankCardData extends Instance {
	public function request(string $number) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2e79d779);
		$writer->tgwriteBytes($number);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>