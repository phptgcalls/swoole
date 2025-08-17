<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel bool enabled
 * @return Updates
 */

final class ToggleJoinToSend extends Instance {
	public function request(object $channel,bool $enabled) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe4cb9580);
		$writer->write($channel->read());
		$writer->tgwriteBool($enabled);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>