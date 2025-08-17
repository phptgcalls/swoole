<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param stargiftattributeid attribute int count
 * @return StarGiftAttributeCounter
 */

final class StarGiftAttributeCounter extends Instance {
	public function request(object $attribute,int $count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2eb1b658);
		$writer->write($attribute->read());
		$writer->writeInt($count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['attribute'] = $reader->tgreadObject();
		$result['count'] = $reader->readInt();
		return new self($result);
	}
}

?>