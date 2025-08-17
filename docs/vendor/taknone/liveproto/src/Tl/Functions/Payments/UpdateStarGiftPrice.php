<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputsavedstargift stargift starsamount resell_amount
 * @return Updates
 */

final class UpdateStarGiftPrice extends Instance {
	public function request(object $stargift,object $resell_amount) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xedbe6ccb);
		$writer->write($stargift->read());
		$writer->write($resell_amount->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>