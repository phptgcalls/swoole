<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int expires
 * @return help.PromoData
 */

final class PromoDataEmpty extends Instance {
	public function request(int $expires) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x98f6ac75);
		$writer->writeInt($expires);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['expires'] = $reader->readInt();
		return new self($result);
	}
}

?>