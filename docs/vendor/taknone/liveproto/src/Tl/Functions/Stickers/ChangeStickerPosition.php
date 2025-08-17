<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stickers;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputdocument sticker int position
 * @return messages.StickerSet
 */

final class ChangeStickerPosition extends Instance {
	public function request(object $sticker,int $position) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xffb6d4ca);
		$writer->write($sticker->read());
		$writer->writeInt($position);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>