<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel int seconds
 * @return Updates
 */

final class ToggleSlowMode extends Instance {
	public function request(object $channel,int $seconds) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xedd49ef0);
		$writer->write($channel->read());
		$writer->writeInt($seconds);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>