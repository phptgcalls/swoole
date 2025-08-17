<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stickers;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputdocument sticker
 * @return messages.StickerSet
 */

final class RemoveStickerFromSet extends Instance {
	public function request(object $sticker) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf7760f51);
		$writer->write($sticker->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>