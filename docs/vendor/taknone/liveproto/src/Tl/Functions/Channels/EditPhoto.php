<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel inputchatphoto photo
 * @return Updates
 */

final class EditPhoto extends Instance {
	public function request(object $channel,object $photo) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf12e57c9);
		$writer->write($channel->read());
		$writer->write($photo->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>