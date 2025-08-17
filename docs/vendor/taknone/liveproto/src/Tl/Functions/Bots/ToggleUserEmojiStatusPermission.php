<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot bool enabled
 * @return Bool
 */

final class ToggleUserEmojiStatusPermission extends Instance {
	public function request(object $bot,bool $enabled) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6de6392);
		$writer->write($bot->read());
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