<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id
 * @return BotMenuButton
 */

final class GetBotMenuButton extends Instance {
	public function request(object $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9c60eb28);
		$writer->write($user_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>