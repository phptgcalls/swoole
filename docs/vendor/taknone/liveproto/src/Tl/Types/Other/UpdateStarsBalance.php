<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param starsamount balance
 * @return Update
 */

final class UpdateStarsBalance extends Instance {
	public function request(object $balance) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4e80a379);
		$writer->write($balance->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['balance'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>