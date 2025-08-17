<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stickers;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstickerset stickerset
 * @return Bool
 */

final class DeleteStickerSet extends Instance {
	public function request(object $stickerset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x87704394);
		$writer->write($stickerset->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>