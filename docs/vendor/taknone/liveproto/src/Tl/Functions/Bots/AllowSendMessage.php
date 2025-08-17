<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot
 * @return Updates
 */

final class AllowSendMessage extends Instance {
	public function request(object $bot) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf132e3ef);
		$writer->write($bot->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>