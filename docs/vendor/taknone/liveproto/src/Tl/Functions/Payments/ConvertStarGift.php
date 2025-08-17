<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputsavedstargift stargift
 * @return Bool
 */

final class ConvertStarGift extends Instance {
	public function request(object $stargift) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x74bf076b);
		$writer->write($stargift->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>