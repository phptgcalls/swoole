<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int backdrop_id
 * @return StarGiftAttributeId
 */

final class StarGiftAttributeIdBackdrop extends Instance {
	public function request(int $backdrop_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1f01c757);
		$writer->writeInt($backdrop_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['backdrop_id'] = $reader->readInt();
		return new self($result);
	}
}

?>