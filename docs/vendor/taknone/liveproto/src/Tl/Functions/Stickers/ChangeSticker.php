<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stickers;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputdocument sticker string emoji maskcoords mask_coords string keywords
 * @return messages.StickerSet
 */

final class ChangeSticker extends Instance {
	public function request(object $sticker,? string $emoji = null,? object $mask_coords = null,? string $keywords = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf5537ebc);
		$flags = 0;
		$flags |= is_null($emoji) ? 0 : (1 << 0);
		$flags |= is_null($mask_coords) ? 0 : (1 << 1);
		$flags |= is_null($keywords) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($sticker->read());
		if(is_null($emoji) === false):
			$writer->tgwriteBytes($emoji);
		endif;
		if(is_null($mask_coords) === false):
			$writer->write($mask_coords->read());
		endif;
		if(is_null($keywords) === false):
			$writer->tgwriteBytes($keywords);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>