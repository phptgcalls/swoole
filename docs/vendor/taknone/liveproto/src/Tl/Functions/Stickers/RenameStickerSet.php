<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stickers;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstickerset stickerset string title
 * @return messages.StickerSet
 */

final class RenameStickerSet extends Instance {
	public function request(object $stickerset,string $title) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x124b1c00);
		$writer->write($stickerset->read());
		$writer->tgwriteBytes($title);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>