<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string lang_code inputuser bot
 * @return bots.BotInfo
 */

final class GetBotInfo extends Instance {
	public function request(string $lang_code,? object $bot = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdcd914fd);
		$flags = 0;
		$flags |= is_null($bot) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($bot) === false):
			$writer->write($bot->read());
		endif;
		$writer->tgwriteBytes($lang_code);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>