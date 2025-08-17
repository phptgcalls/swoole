<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stickers;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstickerset stickerset inputstickersetitem sticker
 * @return messages.StickerSet
 */

final class AddStickerToSet extends Instance {
	public function request(object $stickerset,object $sticker) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8653febe);
		$writer->write($stickerset->read());
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