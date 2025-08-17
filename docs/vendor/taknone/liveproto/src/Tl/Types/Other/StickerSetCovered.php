<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param stickerset set document cover
 * @return StickerSetCovered
 */

final class StickerSetCovered extends Instance {
	public function request(object $set,object $cover) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6410a5d2);
		$writer->write($set->read());
		$writer->write($cover->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['set'] = $reader->tgreadObject();
		$result['cover'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>