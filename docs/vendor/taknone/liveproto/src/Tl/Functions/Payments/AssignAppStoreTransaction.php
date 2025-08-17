<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes receipt inputstorepaymentpurpose purpose
 * @return Updates
 */

final class AssignAppStoreTransaction extends Instance {
	public function request(string $receipt,object $purpose) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x80ed747d);
		$writer->tgwriteBytes($receipt);
		$writer->write($purpose->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>