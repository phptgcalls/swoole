<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel string title
 * @return Updates
 */

final class EditTitle extends Instance {
	public function request(object $channel,string $title) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x566decd0);
		$writer->write($channel->read());
		$writer->tgwriteBytes($title);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>