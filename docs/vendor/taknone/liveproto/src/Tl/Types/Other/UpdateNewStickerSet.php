<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param messages stickerset
 * @return Update
 */

final class UpdateNewStickerSet extends Instance {
	public function request(object $stickerset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x688a30aa);
		$writer->write($stickerset->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['stickerset'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>