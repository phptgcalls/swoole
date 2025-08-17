<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputsavedstargift stargift inputpeer to_id
 * @return Updates
 */

final class TransferStarGift extends Instance {
	public function request(object $stargift,object $to_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7f18176a);
		$writer->write($stargift->read());
		$writer->write($to_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>