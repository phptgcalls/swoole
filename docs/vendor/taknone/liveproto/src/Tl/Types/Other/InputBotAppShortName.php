<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot_id string short_name
 * @return InputBotApp
 */

final class InputBotAppShortName extends Instance {
	public function request(object $bot_id,string $short_name) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x908c0407);
		$writer->write($bot_id->read());
		$writer->tgwriteBytes($short_name);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['bot_id'] = $reader->tgreadObject();
		$result['short_name'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>