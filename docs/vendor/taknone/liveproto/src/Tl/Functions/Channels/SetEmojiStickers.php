<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel inputstickerset stickerset
 * @return Bool
 */

final class SetEmojiStickers extends Instance {
	public function request(object $channel,object $stickerset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3cd930b7);
		$writer->write($channel->read());
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