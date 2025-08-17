<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stickers;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputdocument sticker inputstickersetitem new_sticker
 * @return messages.StickerSet
 */

final class ReplaceSticker extends Instance {
	public function request(object $sticker,object $new_sticker) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4696459a);
		$writer->write($sticker->read());
		$writer->write($new_sticker->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>