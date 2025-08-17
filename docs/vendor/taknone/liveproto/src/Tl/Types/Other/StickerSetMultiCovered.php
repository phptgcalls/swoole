<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param stickerset set Vector<Document> covers
 * @return StickerSetCovered
 */

final class StickerSetMultiCovered extends Instance {
	public function request(object $set,array $covers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3407e51b);
		$writer->write($set->read());
		$writer->tgwriteVector($covers,'Document');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['set'] = $reader->tgreadObject();
		$result['covers'] = $reader->tgreadVector('Document');
		return new self($result);
	}
}

?>