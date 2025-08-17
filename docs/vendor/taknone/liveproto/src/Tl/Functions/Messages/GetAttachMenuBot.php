<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot
 * @return AttachMenuBotsBot
 */

final class GetAttachMenuBot extends Instance {
	public function request(object $bot) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x77216192);
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