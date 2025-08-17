<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param stickerset set
 * @return StickerSetCovered
 */

final class StickerSetNoCovered extends Instance {
	public function request(object $set) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x77b15d1c);
		$writer->write($set->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['set'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>