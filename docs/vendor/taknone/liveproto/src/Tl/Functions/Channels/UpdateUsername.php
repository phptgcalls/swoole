<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel string username
 * @return Bool
 */

final class UpdateUsername extends Instance {
	public function request(object $channel,string $username) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3514b3de);
		$writer->write($channel->read());
		$writer->tgwriteBytes($username);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>