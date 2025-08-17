<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel bool enabled bool tabs
 * @return Updates
 */

final class ToggleForum extends Instance {
	public function request(object $channel,bool $enabled,bool $tabs) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3ff75734);
		$writer->write($channel->read());
		$writer->tgwriteBool($enabled);
		$writer->tgwriteBool($tabs);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>