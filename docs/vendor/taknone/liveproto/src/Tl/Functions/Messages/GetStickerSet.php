<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstickerset stickerset int hash
 * @return messages.StickerSet
 */

final class GetStickerSet extends Instance {
	public function request(object $stickerset,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc8a0ec74);
		$writer->write($stickerset->read());
		$writer->writeInt($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>