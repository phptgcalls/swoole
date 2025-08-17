<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param datajson receipt inputstorepaymentpurpose purpose
 * @return Updates
 */

final class AssignPlayMarketTransaction extends Instance {
	public function request(object $receipt,object $purpose) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdffd50d3);
		$writer->write($receipt->read());
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