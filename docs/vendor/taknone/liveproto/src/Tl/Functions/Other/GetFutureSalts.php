<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int num
 * @return FutureSalts
 */

final class GetFutureSalts extends Instance {
	public function request(int $num) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb921bd04);
		$writer->writeInt($num);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>