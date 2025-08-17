<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel inputstickerset stickerset
 * @return Bool
 */

final class SetStickers extends Instance {
	public function request(object $channel,object $stickerset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xea8ca4f9);
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