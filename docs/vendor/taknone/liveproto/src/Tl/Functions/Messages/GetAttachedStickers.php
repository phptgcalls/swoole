<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstickeredmedia media
 * @return Vector<StickerSetCovered>
 */

final class GetAttachedStickers extends Instance {
	public function request(object $media) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcc5b67cc);
		$writer->write($media->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>