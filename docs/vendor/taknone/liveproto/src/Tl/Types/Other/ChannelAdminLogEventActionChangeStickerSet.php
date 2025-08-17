<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstickerset prev_stickerset inputstickerset new_stickerset
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionChangeStickerSet extends Instance {
	public function request(object $prev_stickerset,object $new_stickerset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb1c3caa7);
		$writer->write($prev_stickerset->read());
		$writer->write($new_stickerset->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prev_stickerset'] = $reader->tgreadObject();
		$result['new_stickerset'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>